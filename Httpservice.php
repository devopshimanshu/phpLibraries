<?php
/**
* HttpService is a class use for sending and recieving web services details
*
*
* @version    1.0v
* @since      18-10-2016
* @Author     Himanshu Phoolwar
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Httpservice{


/*
*   @function       : httpPost
*   @type           : public(access outside the class)
*   @params         : url, params, debug
*   @return         : json object
*   @comments       : curl function for web services propogation
*   @instruction    : $object->httpPost($url,$params, $debug);
*/  
    public function httpPost($url,$params, $debug = null)
    {
        $params['source']   =   'houseviz';
        $data_json = $this->jsonEncoder($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);
        if(!empty($debug)){
            $info    = curl_getinfo($ch);
            $this->pr($info);
            $this->pr($response);
            die('line number 40 at HttpService class from Houseviz ');
        }
        curl_close($ch);
		$response = $this->jsonDecode($response);
        return $response;

    }
    


/*
*   @function       : httpPut
*   @type           : public(access outside the class)
*   @params         : url, params, debug
*   @return         : json object
*   @comments       : curl function for web services propogation
*   @instruction    : $object->httpPut($url,$params, $debug);
*/ 
    public function httpPut($url,$params, $debug = null)
    {
		$params['source']   =   'houseviz';
        $data_json = $this->jsonEncoder($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);
        if(!empty($debug)){
            $info    = curl_getinfo($ch);
            $this->pr($info);
            $this->pr($response);
            die('line number 72 at HttpService class from Houseviz');
        }
        curl_close($ch);
        $response = $this->jsonDecode($response);
        return $response;
    }
	
	/*
	*   @function       : httpDelete
	*   @type           : public(access outside the class)
	*   @params         : url, params, debug
	*   @return         : json object
	*   @comments       : curl function for web services propogation
	*   @instruction    : $object->httpPut($url,$params, $debug);
	*/ 
    public function httpDelete($url,$params,$debug = null)
    {
		$params['source']   =   'houseviz';
        $data_json = $this->jsonEncoder($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);
        if(!empty($debug)){
            $info    = curl_getinfo($ch);
            $this->pr($info);
            $this->pr($response);
            die('line number 98 at HttpService class from Houseviz');
        }
        curl_close($ch);
		$response = $this->jsonDecode($response);
        return $response;
    }
	
	
	public function httpGet($url,$debug = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);
        if(!empty($debug)){
            $info    = curl_getinfo($ch);
            $this->pr($info);
            $this->pr($response);
            die('line number 117 at HttpService class from Houseviz');
        }
        curl_close($ch);
		$response = $this->jsonDecode($response);
        return $response;
    }
 
    
/*
*   @function       : httpAccepter
*   @type           : public(access outside the class)
*   @params         : null
*   @return         : array
*   @comments       : recieves the json data from the stream
*   @instruction    : $object->httpAccepter();
*/
    public function httpAccepter()
    {
        $data = file_get_contents('php://input');
        $result = $this->jsonDecode($data);
		return $result;
    }


/*
*   @function       : jsonEncoder
*   @type           : private(access inside the class)
*   @params         : string
*   @return         : json string
*   @comments       : convert string into json
*   @instruction    : $object->jsonEncoder($string);
*/
    private function jsonEncoder($string)
    {
        return json_encode($string);
    }
    
    
/*
*   @function       : jsonDecode
*   @type           : private(access inside the class)
*   @params         : string
*   @return         : array
*   @comments       : convert json to string
*   @instruction    : $object->jsonDecode();
*/
    private function jsonDecode($string)
    {
        return json_decode($string, true);
    }
    
    
/*
*   @function       : exitApp
*   @type           : public(access inside the class)
*   @params         : array
*   @return         : null
*   @comments       : convert result into json and terminate the connection
*   @instruction    : $object->jsonDecode();
*/
    public function exitAppSuccess($data)
    {
        http_response_code(200);
        echo $this->jsonEncoder($data);
        exit();
    }

  
/*
*   @function       : pr
*   @type           : private(access outside the class)
*   @params         : content
*   @return         : null
*   @comments       : print data into the screen in a formated manner
*   @instruction    : $object->pr();
*/
    public function pr($content)
    {
        echo '<pre>';
        print_r($content);
        echo '</pre>';
    }
	
/*
*   @function       : exitAppError
*   @type           : public(access inside the class)
*   @params         : int code,string errormsg
*   @return         : null
*   @comments       : convert result into json and terminate the connection
*   @instruction    : $object->jsonDecode();
*/	
	
	public function exitAppError($code,$errormsg)
	{
		http_response_code($code);
		$ms=array("code"=>$code,"msg"=>$errormsg);
        echo $this->jsonEncoder($ms);
        exit();
	}
}

?>
