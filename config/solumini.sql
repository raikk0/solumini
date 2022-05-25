-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 25-Maio-2022 às 12:37
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `solumini`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `description` text,
  `address` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_companies_1_idx` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `companies`
--

INSERT INTO `companies` (`id`, `name`, `category_id`, `city`, `state`, `description`, `address`, `created`, `modified`) VALUES
(1, 'Pizzaria Pimentel', 1, 'Itatinga', 'SP', 'As melhores pizzas de Itatinga', 'Rua Azul, Nº 121, Vila São Pablo', '2021-05-25 14:26:58', '2021-05-25 14:26:58'),
(2, 'Restaurante Dos Costa', 1, 'Botucatu', 'SP', 'Ambiente interno e entregas. Venha comer o Costão!', 'Rua Pedregulho, Nº 77, Vila Batatinha', '2021-05-25 14:26:58', '2021-05-25 14:26:58'),
(3, 'Kimura Systems', 2, 'Botucatu', 'SP', 'Desenvolvimento de software e sisteminhas da pesada que aprontam altas confusões.', 'Avenida dos Estudantes, Nº 810, Bairro Molhado', '2021-05-25 14:26:58', '2021-05-25 14:26:58'),
(5, 'Solutudo', 2, 'Botucatu', 'SP', 'Desde 2005 ajudando a o Brasil a encontrar empresas em sua região.', 'Rua do Padre, Nº 192, Vila Bacana 2', '2021-05-25 14:26:58', '2021-05-25 14:26:58'),
(6, 'Disk Máscara do Papai', 3, 'Marília', 'SP', 'Máscaras PFF2 e para o carnaval também.', 'Rua Salgueiro Doce, Nº 17, Vila Mônica', '2021-05-25 14:26:58', '2021-05-25 14:26:58'),
(7, 'Hospital São Bento', 4, 'Avaré', 'SP', 'Tratando sempre com carinho seus pacientes.', 'Praça Ronald Golias, Nº 767, Vila Engraçada', '2021-05-25 14:26:58', '2021-05-25 14:26:58'),
(8, 'PetsCão', 5, 'Rio de Janeiro', 'RJ', 'Os melhores petiscos para o seu cão e gato', 'Do outro lado agora', '2022-05-19 03:28:03', '2022-05-19 03:28:03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `company_categories`
--

DROP TABLE IF EXISTS `company_categories`;
CREATE TABLE IF NOT EXISTS `company_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `image_file` text NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `company_categories`
--

INSERT INTO `company_categories` (`id`, `name`, `image_file`, `created`) VALUES
(1, 'Alimentação', 'alimentacao.png', NULL),
(2, 'Serviços', 'servicos.png', NULL),
(3, 'Comércio', 'comercio.png', NULL),
(4, 'Saúde', 'saude', NULL),
(5, 'Pets', 'pets', '2022-05-18 22:10:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `company_phones`
--

DROP TABLE IF EXISTS `company_phones`;
CREATE TABLE IF NOT EXISTS `company_phones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `number` varchar(30) DEFAULT NULL,
  `is_main` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_company_phones_1_idx` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `company_phones`
--

INSERT INTO `company_phones` (`id`, `company_id`, `number`, `is_main`, `created`) VALUES
(1, 1, '14999995678', 1, '2021-05-25 14:28:59'),
(2, 2, '1438881234', 0, '2021-05-25 14:28:59'),
(3, 2, '1438881234', 0, '2021-05-25 14:28:59'),
(5, 5, '1438881234', 1, '2021-05-25 14:29:00'),
(6, 7, '14999995678', 1, '2021-05-25 14:29:00'),
(7, 6, '14999995678', 1, '2021-05-25 14:29:01'),
(8, 2, '14999995678', 1, '2021-05-25 14:29:01'),
(14, 5, '14997985358', 0, NULL),
(16, 8, '997985358', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contracts`
--

DROP TABLE IF EXISTS `contracts`;
CREATE TABLE IF NOT EXISTS `contracts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_owner` varchar(250) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `seller_name` varchar(250) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contracts_1_idx` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `contracts`
--

INSERT INTO `contracts` (`id`, `company_owner`, `company_id`, `seller_name`, `expire_date`, `created`) VALUES
(1, 'Bruno Kimura', 2, 'Emanuel Costa', '2021-06-15', '2020-06-15 19:31:12'),
(3, 'Thiago Victal', 1, 'Renan Nogueira', '2022-06-30', '2022-05-19 03:29:05'),
(5, 'Thiago Victal 2', 8, 'Renan Nogueira', '2022-07-30', NULL);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `fk_companies_1` FOREIGN KEY (`category_id`) REFERENCES `company_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `company_phones`
--
ALTER TABLE `company_phones`
  ADD CONSTRAINT `fk_company_phones_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `fk_contracts_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
