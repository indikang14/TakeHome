<?php
//formatting HTTP requests with handler class
require_once("SimpleRest.php");
require_once("Company.php");
		
class CompanyRestHandler extends SimpleRest {

	function getAllCompanies() {	

		$employee = new Company();
		$rawData = $employee->getAllCompanies();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('success' => 0);		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		
		$result["output"] = $rawData;
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($result);
			echo $response;
		}
	}
	
	
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
}
?>