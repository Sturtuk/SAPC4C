<?php
ob_start();
include 'xmlcode.php';
include 'ByDSoapClient.php';
$headerStart = strtotime(date('Y-m-d H:i:s'));

ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);

header("Content-Type: application/json");

				$auth = array('login' => '<username here>', 'password' => '<password here>');

				$wsdl = 'wsdl/ManageAccounts.wsdl';
				$location = 'https://<Host ID>.crm.ondemand.com/sap/bc/srt/scs/sap/managecustomerin1?sap-vhost=<Host ID>.crm.ondemand.com';
				$soapClient = new ByDSoapClient($wsdl, $location, $auth);
				$xml  = Createcustomer($_REQUEST['name'],$_REQUEST['email'],$_REQUEST['contact']);
				$soapVar = generateSoapVar($xml);
				$result = $soapClient->MaintainBundle_V1(new SoapParam($soapVar, 'CustomerBundleMaintainRequestMessage'));

print_r($result);