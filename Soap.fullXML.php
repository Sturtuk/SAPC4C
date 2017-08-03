<?php
/**
*  @ class feedSoap is sending custom XML file to SAP C4C system
*
*
*/
class feedSoap extends SoapClient
{
	var $XMLStr = "";
	function setXMLStr($value)
	{
		$this->XMLStr = $value;
	}

	function getXMLStr()
	{
		return $this->XMLStr;
	}

	function __doRequest($request, $location, $action, $version)
	{
		$request = $this->XMLStr;
		$dom = new DOMDocument('1.0');
		try {
			$dom->loadXML($request);
		}

		catch(DOMException $e) {
			die($e->code);
		}

		$request = $dom->saveXML();

		// doRequest

		return parent::__doRequest($request, $location, $action, $version);
	}

	function SoapClientCall($SOAPXML)
	{
		return $this->setXMLStr($SOAPXML);
	}
}