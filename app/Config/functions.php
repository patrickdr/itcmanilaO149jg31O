<?php

    function SBcurl($url){
        $ch = curl_init();
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // grab URL and pass it to the browser
        $result = curl_exec($ch);
        // close cURL resource, and free up system resources
        curl_close($ch);            
        
        return $result;
    } 
    
    function SBdump($data){
	
        if(is_array($data)){
            echo "<pre>".print_r($data,true)."</pre>";
        }
        else{
            echo "<pre>".$data."</pre>";
        }
        
    }
    function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
    
    function getDateTimeNow(){
        $date = new DateTime();
        return $date->format('Y-m-d H:i:s');
    }
    
    function getDateTimeTomorrow($format = 'Y-m-d H:i:s'){
        $date = new DateTime();
        $date->modify('+1 day');
        return $date->format($format);
    }
    function getDateTimeWithOptions($format = 'Y-m-d H:i:s', $add = 0){
        $date = new DateTime();
        if($add){
          $date->modify('+'.$add.' day');
        }
        return $date->format($format);
    }     
    
    function array_map_key_index($contents, $indexes = array()){
      $output = array();
      foreach($contents as $content){
        $value = $content;
        foreach($indexes as $index){
          $value = (isset($value[$index])) ? $value[$index] : "";
        }
        if(!is_array($value)){
          $output[$value] = $content;
        }
      }
      return $output;
    }
