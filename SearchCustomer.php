<?php
ob_start();
include 'MSSoapClient.php';
include 'class.php';

$headerStart = strtotime(date('Y-m-d H:i:s'));
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);

header("Content-Type: application/json");

	if(isset($_REQUEST['email'])){
			$client = new MSSoapClient("wsdl/QueryAccounts.wsdl", array('verify_peer' => true,
                'allow_self_signed' => true,
                'connection_timeout' => 300,'trace' => 1, "exceptions" => 0, 'use' => SOAP_SSL_METHOD_SSLv3, 'login'          => "<username>",
                                            'password'       => "<password>"));

			$xml  = xmlCustomerSearch($_REQUEST['email']);
			$soapVar = generateSoapVar($xml);
			$client->FindByIdentification(new SoapParam($soapVar, 'QueryCustomerIn'));
		    print_r($client->__last_response);
	}