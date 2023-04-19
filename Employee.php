<?php
require_once("dbcontroller.php");
/* 
A domain Employee Class
*/
Class Employee {
	private $employees = array();
	//function to get 
	public function getAllEmployees(){

		if(isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
			$id = $_GET["id"];
			$query = 'SELECT * FROM Employees WHERE id = ' .$id;
		}
		else {
			$query = 'Select e.firstname, e.lastname, e.salary, c.companyName From Employees e
			Join Company c ON e.companyId = c.companyId' ;
		}
		$dbcontroller = new DBController();
		$this->employees = $dbcontroller->executeSelectQuery($query);
	
		return $this->employees;
	}

	public function addEmployee(){
		if(isset($_POST['firstname'])){
			$first_name = $_POST['firstname'];
				$last_name = '';
				$salary = '';
			if(isset($_POST['lastname'])){
				$last_name = $_POST['lastname'];
			}
			if(isset($_POST['salary'])){
				$salary = $_POST['salary'];
			}	
			$query = "insert into Employees (firstname,lastname,salary) values ('" . $first_name ."','". $last_name ."','" . $salary ."')";
			$dbcontroller = new DBController();
			$result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			}
		}
	}

	public function deleteEmployee(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$query = 'DELETE FROM Employees WHERE id = '.$id;
			$dbcontroller = new DBController();
			$result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			}
		}
	}
	
	public function editEmployee(){
		if(isset($_POST["firstname"]) && isset($_GET["id"])){
			$id = trim($_GET["id"]);
			$first_name = trim($_POST["firstname"]);
				$last_name = '';
				$salary = '';
			if(isset($_POST["lastname"])){
				$last_name = $_POST["lastname"];
			}
			if(isset($_POST["salary"])){
				$salary = trim($_POST["salary"]);
			}	
			$query = "UPDATE Employees SET firstname = '".$first_name."',lastname ='". $last_name ."', salary = '".(int) $salary ."' WHERE id = ".$id;
			$dbcontroller = new DBController();
			$result = $dbcontroller->executeQuery($query);
			if($result!= 0){
				$result = array('success'=>1);
				return $result;
			}
		}
	}
	
}
?>