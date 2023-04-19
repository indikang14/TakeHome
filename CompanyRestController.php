<?php
require_once("CompanyRestHandler.php");
$method = $_SERVER['REQUEST_METHOD'];
$view = "";
if(isset($_GET["page_key"])) {
	$page_key = $_GET["page_key"];
}
/*
controls the RESTful services
URL mapping from .htcAccess file 
*/
	switch($page_key){

		case "list":
			// to handle REST Url /company/list/
			$companyRestHandler = new CompanyRestHandler();
			$result = $companyRestHandler->getAllCompanies();
			break;

}
?>
