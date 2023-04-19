<?php
require_once("dbcontroller.php");
/* 
A domain Company Class
*/
Class Company {
	private $companies = array();
	//function to get 
	public function getAllCompanies(){

		if(isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
			$id = $_GET["id"];
			$query = 'SELECT * FROM Company WHERE companyId = ' .$id;
		}
		else {
			$query = 'SELECT * FROM Company' ;
		}
		$dbcontroller = new DBController();
		$this->companies = $dbcontroller->executeSelectQuery($query);
	
		return $this->companies;
	}

	
	
}
?>