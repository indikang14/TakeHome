<?php
require_once("EmployeeRestHandler.php");
$method = $_SERVER['REQUEST_METHOD'];
$view = "";
if(isset($_GET["page_key"]))
	$page_key = $_GET["page_key"];
/*
controls the RESTful services
URL mapping from .htcAccess file 
*/
	switch($page_key){

		case "list":
			// to handle REST Url /employee/list/
			$employeeRestHandler = new EmployeeRestHandler();
			$result = $employeeRestHandler->getAllEmployees();
			break;
	
		case "create":
			// to handle REST Url /employee/create/
			$employeeRestHandler = new EmployeeRestHandler();
			$employeeRestHandler->add();
		break;
		
		case "delete":
			// to handle REST Url /employee/delete/<row_id>
			$employeeRestHandler = new EmployeeRestHandler();
			$result = $employeeRestHandler->deleteEmployeeById();
		break;
		
		case "update":
			// to handle REST Url /employee/update/<row_id>
			$employeeRestHandler = new EmployeeRestHandler();
			$employeeRestHandler->editEmployeeById();
		break;
}
?>
