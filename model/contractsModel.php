<?php

class Contracts
{
	private $id;
	private $name;

	public static function getAll()
	{
		$conn = new Database();
		$result = $conn->executeQuery('SELECT * FROM companies');
		return $result;
	}

	public static function getContractsIds()
	{
		$conn = new Database();
		$result = $conn->executeQuery('SELECT contracts.id, expire_date, companies.name, companies.id as company_id FROM contracts INNER JOIN companies ON contracts.company_id = companies.id');
		return $result;
	}

		public static function getContractById($id)
	{
		$conn = new Database();
		$result = $conn->executeQuery('SELECT contracts.id, company_owner, company_id, seller_name, expire_date, companies.name FROM contracts INNER JOIN companies ON contracts.company_id = companies.id WHERE contracts.id = '.$id.'');
		return $result;
	}

	public static function updateContract($id, $data){
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
		$result = $conn->executeQuery('UPDATE contracts SET '.$set.' WHERE id = '.$id);
		return $result;
	}

	public static function insertContract($data){
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
		$result = $conn->executeQuery('INSERT INTO contracts ('.$fields.') VALUES ('.$values.')');
		return $result;
	}

	public static function deleteContract($id)
	{
		$conn = new Database();
		$result = $conn->executeQuery('DELETE FROM contracts WHERE id = '.$id.'');
		return $result;
	}

}

?>