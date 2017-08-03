<?php
ob_start();
include 'ByDSoapClient.php';
include 'Soap.fullXML.php';
include 'xmlcode.php';

$headerStart = strtotime(date('Y-m-d H:i:s'));

ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);

header("Content-Type: application/json");

if(isset($_REQUEST['email'])){

			
			    	$auth = array('login' => '<username here>', 'password' => '<password here>');

					$wsdl = 'wsdl/ManageAccounts.wsdl';
					$location = 'https://<Host ID>.crm.ondemand.com/sap/bc/srt/scs/sap/managecustomerin1?sap-vhost=<Host ID>.crm.ondemand.com';
					$soapClient = new ByDSoapClient($wsdl, $location, $auth);
					$xml  = Createcustomer($_REQUEST['name'],$_REQUEST['email'],$_REQUEST['contact']);
					$soapVar = generateSoapVar($xml);
					$result = $soapClient->MaintainBundle_V1(new SoapParam($soapVar, 'CustomerBundleMaintainRequestMessage'));
				
				
					$CustomerID = $result->Customer->InternalID;

			
					$xml  = CreateLead($CustomerID,$_REQUEST['subject'],$_REQUEST['message']);
					
					$data = soapCall("wsdl/ManageLeads.wsdl","MaintainBundle",$xml);
					
					$doc = new DOMDocument('1.0', 'utf-8');
				    $doc->loadXML( $data );
				    $XMLresults     = $doc->getElementsByTagName("UUID");
				    $output = $XMLresults->item(0)->nodeValue;
				     $f = array(
				    			'UUID' =>	$output,
				    	  );
				    print_r(json_encode($f));

		    }
}



			
