<?php
require_once 'model/categoriesModel.php';
require_once 'model/companiesModel.php';

class CompaniesController {

	public function index() {
		$categoriesDb = new Categories();
		$companiesDb = new Companies();
		
		$categories = $categoriesDb->getAll();
		
		foreach ($categories['data'] as $key=>$value){
			$categories['data'][$key]['qtdCompanies'] = $companiesDb->getCountCategory($value['id'])['data'][0]['COUNT(id)'];
		}

		$_REQUEST['categories'] = $categories;
		require_once 'view/home.php';
	}


	public function company(){
		$companiesDb = new Companies();
		$company = $companiesDb->getCompanyById($_REQUEST["company_id"]);
		$phones = $companiesDb->getCompanyPhones($_REQUEST["company_id"]);
		$companyName = $_REQUEST["cname"];
		if ($companyName != str_replace(" ", "-", $company["data"][0]["name"]))
		{
			Header("Location: /solumini/mistaken");
		}
		$company['phones'] = $phones;
		$_REQUEST['company'] = $company;
		require_once 'view/company.php';
	}
}

?>