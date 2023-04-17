<?php
require_once("dbcontroller.php");
/* 
A domain Employee Class
*/
Class Employee {
	private $employees = array();
	//function to get 
	public function getAllEmployees(){
		$query = 'SELECT * FROM Employees';
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
		if(isset($_GET['firstname']) && isset($_GET['lastname']) && isset($_GET['salary']) && isset($_GET['id'])){
			$first_name = $_POST['firstname'];
			$last_name = $_POST['lastname'];
			$salary = $_POST['salary'];
			$query = "UPDATE Employees SET firstname = '".$first_name."',lastname ='". $last_name ."', salary = '". $salary ."' WHERE id = ".$_GET['id'];
		}
		$dbcontroller = new DBController();
		$result= $dbcontroller->executeQuery($query);
		if($result != 0){
			$result = array('success'=>1);
			return $result;
		}
	}
	
}
?>