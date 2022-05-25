<?php



class Companies
{
	private $id;
	private $name;

	public static function getAll()
	{
		$conn = new Database();
		$result = $conn->executeQuery('SELECT * FROM companies ORDER BY name ASC');
		return $result;
	}

	public static function getCountCategory($catId)
	{
		$conn = new Database();
		$result = $conn->executeQuery('SELECT COUNT(id) FROM companies WHERE category_id = '.$catId);
		return $result;
	}

	public static function getByCategory($catId)
	{
		$conn = new Database();
		$result = $conn->executeQuery('SELECT companies.id, companies.name, companies.city, companies.state, companies.description, companies.address, contracts.expire_date FROM companies LEFT JOIN `contracts` ON companies.id = contracts.company_id WHERE category_id = '.$catId.' ORDER BY contracts.expire_date DESC');
		return $result;
	}

	public static function getCompanyById($compId)
	{
		$conn = new Database();
		$result = $conn->executeQuery('SELECT company_categories.name as category, companies.id, companies.category_id, companies.name, companies.city, companies.state, companies.description, companies.address, contracts.expire_date FROM companies LEFT JOIN `contracts` ON companies.id = contracts.company_id INNER JOIN `company_categories` ON company_categories.id = companies.category_id WHERE companies.id = '.$compId);
		return $result;
	}

	public static function getCompanyPhones($compId)
	{
		$conn = new Database();
		$result = $conn->executeQuery('SELECT * FROM company_phones WHERE company_id = '.$compId.' ORDER BY is_main DESC');
		return $result;
	}

	public static function getCompaniesNames()
	{
		$conn = new Database();
		$result = $conn->executeQuery('SELECT id, name FROM companies');
		return $result;
	}

	public static function updateCompany($id, $data){
		$conn = new Database();
		$set = '';
		$fieldsQtd = count($data);
		$i = 0;
		foreach($data as $field => $value)
		{
			$i++;
			$set .= $field." = '".$value."'";
			if($i < $fieldsQtd)
				$set .= ', ';
		}
		$result = $conn->executeQuery('UPDATE companies SET '.$set.' WHERE id = '.$id);
		return $result;
	}

	public static function insertCompany($data){
		$conn = new Database();
		$fields = '';
		$values = '';
		$fieldsQtd = count($data);
		$i = 0;
		foreach($data as $field => $value)
		{
			$i++;
			$fields .= $field;
			$values .= "'".$value."'";
			if($i < $fieldsQtd){
				$fields .= ', ';
				$values .= ', ';
			}
		}
		$result = $conn->executeQuery('INSERT INTO companies ('.$fields.') VALUES ('.$values.')');
		return $result;
	}

	public static function deleteCompany($id)
	{
		$conn = new Database();
		$result = $conn->executeQuery('DELETE FROM companies WHERE id = '.$id.'');
		$result = $conn->executeQuery('DELETE FROM company_phones WHERE company_id = '.$id.'');
		$result = $conn->executeQuery('DELETE FROM contracts WHERE company_id = '.$id.'');
		return $result;
	}

		public static function getByName($text)
	{
		$conn = new Database();
		$result = $conn->executeQuery("SELECT * FROM companies INNER JOIN contracts ON companies.id = contracts.company_id WHERE companies.name LIKE '%".$text."%'");
		return $result;
	}

	public static function insertPhone($company_id, $number){
		$conn = new Database();
		$result = $conn->executeQuery("INSERT INTO company_phones (company_id, number, is_main) VALUES ('".$company_id."', '".$number."', '0')");
		return $result;
	} 

	public static function deletePhone($id)
	{
		$conn = new Database();
		$result = $conn->executeQuery('DELETE FROM company_phones WHERE id = '.$id.'');
		return $result;
	}

	public static function toggleMainPhone($id, $val)
	{
		$conn = new Database();
		$result = $conn->executeQuery("UPDATE company_phones SET is_main = '".$val."' WHERE id = ".$id);
		return $result;
	}

}


?>