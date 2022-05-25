<?php
require_once 'model/companiesModel.php';

class SearchController {

	public function index() {
		$companiesDb = new Companies();

		$text = $_REQUEST['text'];
		$companies = $companiesDb->getByName($text);

		$_REQUEST['result'] = $companies;

		require_once 'view/search.php';
	}

}
?>