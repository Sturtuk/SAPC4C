<?php

global $loginDetails;
$loginDetails = array(
                'verify_peer' => true,
                'allow_self_signed' => true,
                'connection_timeout' => 300,
                'exceptions' => true,
                'login' => '',
                'password' => ''
);

class ByDSoapClient extends SoapClient
{
        private $defaultLocation = null;

        function __construct($wsdl, $location, $options)
        {
                global $loginDetails;
                
                $this->defaultLocation = $location;

                use_soap_error_handler(true);
                parent::__construct($wsdl, array_merge($loginDetails, $options));
        }

        function __doRequest($soapRequest, $location, $action, $version, $one_way = NULL)
        {
                $domDocument = new DOMDocument("1.0");

                $location = $this->defaultLocation;

                // Read the language from the configuration file
                $language = 'EN';
                if (!empty($language)) {
                        $location  = $location . '?sap-language=' . $language;
                }

                //Consuming the web service
                $soapResponse = parent::__doRequest($soapRequest, $location, $action, $version);

                if (empty($soapResponse))
                {
                        throw new Exception($this->__soap_fault->faultcode . ": Cannot connect to host: $location. Reason:" . $this->__soap_fault->getMessage());
                }

                return $soapResponse;
        }
}
?>