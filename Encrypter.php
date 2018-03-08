<?php
/**
* Encrypter Class is a class which will encrypt data for the application
*
* Get the initial string combine it with a salt value 
* (generated randomly through alphabets array) encoded 
* it with base64 and then urlencoded then we add the 
* alphabet in that string so that we can decrypt the 
* string. Convert the alphabet into number place and 
* you get the number of character used in the salt and 
* you can remove that salt. 
*
* @version    1.0v
* @since      06-10-2016
* @Author     Himanshu Phoolwar
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Encrypter{
    
    private $eArray     = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
    
    private $len        = 0;
    
    private $randString = '';
    
    private $enString   = '';
    
    private $baseString = '';
    
    public function __constructor(){
        
    }
    
/*
*   @function       : encryptionString
*   @type           : public(access outside the class)
*   @params         : string
*   @return         : string
*   @comments       : get the input and initailize all the methods for encryption
*   @instruction    : $object->encryptionString($string);
*/    
    public function encryptionString($string = null){
        if($string == null || !is_string($string)){
            return 0;
        }
        $this->baseString = $string;
        $this->getSaltLen();
        $this->saltString();
        $this->encryptedString();
        return $this->enString;
    }
    

/*
*   @function       : getSaltLen
*   @type           : private (access only inside the class)
*   @params         : NULL
*   @return         : NULL
*   @comments       : Set len variable with alphabet with the help of eArray array.
*   @instruction    : $this->getSaltLen();
*/ 
    private function getSaltLen(){
        $this->len = array_rand($this->eArray);
    }
    
/*
*   @function       : saltString
*   @type           : private (access only inside the class)
*   @params         : NULL
*   @return         : NULL
*   @comments       : set randString variable using the len variable which will be used as salt string
*   @instruction    : $this->getSaltLen();
*/ 

     private function saltString() {
        
        $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($char);
        for ($i = 0; $i < $this->len; $i++) {
            $this->randString .= $char[rand(0, $charactersLength - 1)];
        }
    }
    
    
/*
*   @function       : encryptedString
*   @type           : private (access only inside the class)
*   @params         : NULL
*   @return         : NULL
*   @comments       : combine slat values and the accesskey value and also encode the string into byte data stream.
*   @instruction    : $this->encryptedString();
*/    
    private function encryptedString(){
        $key = $this->randString.$this->baseString;
        $key = $this->bEncode($key);
        $this->enString = $this->eArray[$this->len].$this->urlCoder($key);
    }
    
     
/*
*   @function       : bEncode
*   @type           : private (access only inside the class)
*   @params         : (string)$string
*   @return         : (string) base64 encoded
*   @comments       : encode the given param into base64
*   @instruction    : $this->bEncode($string);
*/     
    private function bEncode($string){
        return base64_encode($string);
    }
    
    
/*
*   @function       : urlCoder
*   @type           : private (access only inside the class)
*   @params         : (string)$string
*   @return         : (string) urlencode 
*   @comments       : encode the given param into urlencoded
*   @instruction    : $this->urlCoder($string);
*/    
    private function urlCoder($string){
        return urlencode($string);
    }

}

?>
