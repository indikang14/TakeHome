<?php
//creating a config php script to connect to Employees DB referenced in .sql file 

define("SERVER_NAME", "127.0.0.1");
define("user_name", "root");
define("password", "Bluejays@14");
define("Database_name", "TakeHome");

//create connection
$conn = new mysqli(SERVER_NAME, user_name, password, Database_name);
//connect to mysql server ss
if($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

?>