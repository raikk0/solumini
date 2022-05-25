<?php
require_once 'model/categoriesModel.php';
require_once 'model/companiesModel.php';
require_once 'model/contractsModel.php';

class AdminController {

	public function index() {
		$companiesDb = new Companies();
		$companies = $companiesDb->getCompaniesNames();
		$companies['selected'] = [];

		// Empresas
		if ($_REQUEST['type'] == "1")
		{
			
			$category = new Categories();

			
			$categories = $category->getAll();
			
			if(!empty($_REQUEST['selected']))
			{
				$selected = $companiesDb->getCompanyById($_REQUEST['selected']);
				$phones = $companiesDb->getCompanyPhones($_REQUEST['selected']);
				$companies['selected'] = $selected;
				$companies['selected']['phones'] = $phones;
			}
			
			$_REQUEST['data'] = $companies;
			$_REQUEST['data']['categories'] = $categories;
		}

		// Contratos
		else if ($_REQUEST['type'] == "2")
		{
			$contractsDb = new Contracts();
			$contracts = $contractsDb->getContractsIds();
			$companiesOk = [];
			
			if(!empty($_REQUEST['selected']))
			{
				$selected = $contractsDb->getContractById($_REQUEST['selected']);
				$contracts['selected'] = $selected;
				$companiesOk['data'][] = ["id" => $selected['data'][0]['company_id'], "name" => $selected['data'][0]['name']];
			}
			$_REQUEST['data'] = $contracts;

			foreach($companies['data'] as $comp)
			{
				$ck = 0;
				foreach($contracts['data'] as $contr)
				{	
					if($contr['company_id'] == $comp['id'])
						$ck = 1;
				}
				if($ck == 0)
					$companiesOk['data'][] = $comp;
			}
			
			$_REQUEST['data']['companies'] = $companiesOk;
		}
		require_once 'view/admin.php';
	}

	public function insertUpdate(){
		// var_dump($_POST);
	
		// Empresas
		if ($_REQUEST['type'] == 1){
			$companiesDb = new Companies();

			$data = [
				'name' => $_POST['inputName'],
				'category_id' => $_POST['inputCategory'],
				'state' => $_POST['inputState'],
				'city' => $_POST['inputCity'],
				'address' => $_POST['inputAddress'],
				'description' => $_POST['inputDescription'],
			];

			if($_POST['inputId'])
				$query = $companiesDb->updateCompany($_POST['inputId'], $data);
			else
				$query = $companiesDb->insertCompany($data);
		}

		// Contratos
		if ($_REQUEST['type'] == 2){
			$contractsDb = new Contracts();

			$data = [
				'company_owner' => $_POST['inputCompanyOwner'],
				'company_id' => $_POST['inputCompanyId'],
				'seller_name' => $_POST['inputSellerName'],
				'expire_date' => $_POST['inputExpireDate']
			];

			if($_POST['inputId'])
				$query = $contractsDb->updateContract($_POST['inputId'], $data);
			else
				$query = $contractsDb->insertContract($data);
		}

		if($query['errorInfo'][1] > 0){
			echo "<script>
				alert(`".$query['errorInfo'][2]."`);
			</script>";
		}
		$id = $query['lastId'] ?: $_REQUEST['inputId'];
		echo "<script>window.location.href='admin/".$_REQUEST['type']."/".$id."';</script>";
	}

	public function deleteRegistry(){
		// Empresas
		if ($_REQUEST['type'] == 1){
			$companiesDb = new Companies();
			$query = $companiesDb->deleteCompany($_REQUEST['id']);
		}

		// Contratos
		if ($_REQUEST['type'] == 2){
			$contractsDb = new Contracts();
			$query = $contractsDb->deleteContract($_REQUEST['id']);
		}

		echo "<script>window.location.href='admin/".$_REQUEST['type']."';</script>";
	}

	public function insertPhone(){
		$companiesDb = new Companies();
		$number = $_REQUEST['number'];
		$company_id = $_REQUEST['company_id'];
		$phone_id = $_REQUEST['id_number'];

		$query = $companiesDb->insertPhone($company_id, $number);
		echo "<script>window.location.href='admin/".$_REQUEST['type']."/".$company_id."';</script>";
	}

	public function deletePhone()
	{
		$companiesDb = new Companies();
		$query = $companiesDb->deletePhone($_REQUEST['id']);

		$company_id = $_REQUEST['company_id'];
		echo "<script>window.location.href='admin/".$_REQUEST['type']."/".$company_id."';</script>";
	}

	public function toggleMain(){
		$companiesDb = new Companies();
		$query = $companiesDb->toggleMainPhone($_REQUEST['id'], $_REQUEST['val']);

		$company_id = $_REQUEST['company_id'];
		echo "<script>window.location.href='admin/".$_REQUEST['type']."/".$company_id."';</script>";
	}
}

?>