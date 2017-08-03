<?php

class MSSoapClient extends SoapClient {

   var $user = "_WEBSITE LEA";
   var $p = "Prestige123";

      function __doRequest($request, $location, $action, $version, $one_way = 0) {
        

        return parent::__doRequest($request, $location, $action, $version, $one_way = 0);
      }
}


function generateSoapVar($xml) {
      try { 
         $soapVar = new SoapVar($xml, XSD_ANYXML, null, null, null); 
         return $soapVar;
      } catch(Exception $e) { 
         $message = $e->getMessage(); 
      }
}