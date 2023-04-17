<?php
class HttpRequestBase {
	private $ch = "";
    //private $httpHeaderArray = ['Content-Type: application/json', 'Accept: application/json'];

	function __construct() {
		
		if($ch = curl_init()) {
			$this->ch = $ch;	
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
                'Content-Type:application/json',
                'Accept:application/json' ));
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		}
        else{
            die("curl handle could not be inititiated!");
        }
	}
	
	function setUpCurlUrl($url) {
		curl_setopt($this->ch, CURLOPT_URL, $url);
	}

    function setUpPostReq(array $postBody) {
        curl_setopt($this->ch, CURLOPT_POST, TRUE);
        //json_encode($postBody);

        curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($postBody));
    }

    function setUpGetReq() {
        curl_setopt($this->ch, CURLOPT_HTTPGET, TRUE);
    }
    function executeCurl() {
        if( ! $result = curl_exec($this->ch))
        {
            trigger_error(curl_error($this->ch));
        }    
        return json_decode($result);
    }
    function killCurl() {
        curl_close($this->ch);
    }
}
?>