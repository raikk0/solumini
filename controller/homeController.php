<?php
require_once 'model/categoriesModel.php';
require_once 'model/companiesModel.php';

class HomeController {

public function index() {
	$category = new Categories();
	$company = new Companies();
	
	$categories = $category->getAll();
	
	foreach ($categories['data'] as $key=>$value){
		$categories['data'][$key]['qtdCompanies'] = $company->getCountCategory($value['id'])['data'][0]['COUNT(id)'];
	}

	$_REQUEST['categories'] = $categories;
	require_once 'view/home.php';
	}
}

?>