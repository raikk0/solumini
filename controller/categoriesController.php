<?php
require_once 'model/categoriesModel.php';
require_once 'model/companiesModel.php';

class CategoriesController {

public function index() {
	
}

public function category(){
	$companiesDb = new Companies();
	$categoriesDb = new Categories();
	$category_id = $_REQUEST['category_id'];

	$companies = $companiesDb->getByCategory($category_id);
	$category = $categoriesDb->getCategoryById($category_id);

	$_REQUEST['companies'] = $companies;
	@$_REQUEST['category_name'] = $category['data'][0]['name'];
	
	require_once 'view/category.php';
	}
}

?>