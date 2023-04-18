<?php
class DBController {
	private $conn = "";
	//replace with your local host server
	private $host = "127.0.0.1";
	//replace with your user 
	private $user = "root";
	private $password = "Bluejays@14";
	//this Database will be created using dbConfig.sql
	private $database = "TakeHome";

	function __construct() {
		$conn = $this->connectDB();
		if(!empty($conn)) {
			$this->conn = $conn;			
		}
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}

	function executeQuery($query) {
        $conn = $this->connectDB();    
        $result = mysqli_query($conn, $query);
        if (!$result) {
            //check for duplicate entry
            if($conn->errno == 1062) {
                return false;
            } else {
                trigger_error (mysqli_error($conn),E_USER_NOTICE);
				
            }
        }		
        $affectedRows = mysqli_affected_rows($conn);
		return $affectedRows;
		
    }
	function executeSelectQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		if(!empty($resultset))
			return $resultset;
	}
}
?>
