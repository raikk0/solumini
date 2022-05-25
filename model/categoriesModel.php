<?php



class Categories
{
	private $id;
	private $name;

	public static function getAll()
	{
		$conn = new Database();
		$result = $conn->executeQuery('SELECT * FROM company_categories');
		return $result;
	}

	public static function getCategoryById($id){
		$conn = new Database();
		$result = $conn->executeQuery('SELECT * FROM company_categories WHERE id ='.$id);
		return $result;
	}
}


?>