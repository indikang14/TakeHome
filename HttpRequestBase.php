<?php
class HttpRequestBase {
	private $ch = "";
	function __construct() {
		
		if($ch = curl_init()) {
			$this->ch = $ch;	
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
                'Content-Type:application/json',
                'Accept:application/json' ));
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		}
        else{
            echo "curl handle could not be inititiated!";
        }
	}
	
	function setUpCurlUrl($url) {
		curl_setopt($this->ch, CURLOPT_URL, $url);
	}

    function setUpPostReq(array $postBody) {
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, 
        array('Accept:application/json','Content-Type:application/x-www-form-urlencoded') );
        $postBodyString = http_build_query($postBody);

        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $postBodyString );
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