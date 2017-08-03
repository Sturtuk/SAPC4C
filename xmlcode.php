<?php

function soapCall($wsdlURL, $callFunction = "", $XMLString)
{
	$client = new feedSoap($wsdlURL, array(
		'allow_self_signed' => true,
		'connection_timeout' => 300,
		'trace' => 1,
		"exceptions" => 0,
		'use' => SOAP_SSL_METHOD_SSLv3,
		'login' => "_WEBSITE LEA",
		'password' => "Prestige123"
	));
	$reply = $client->SoapClientCall($XMLString);
	$client->__call("$callFunction", array() , array());
	return $client->__getLastResponse();
}


/**
*  CreatLead
*  @$clientid is Account ID, after creating SAP C4C Customer, you will get this
*  @$pid is Project ID to which Project you want point the Lead
*  @$message field for Custom Messages
*/
function CreateLead($clientid,$pid,$message =''){

if($clientid != "" AND $pid != "" ):

$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:glob="http://sap.com/xi/SAPGlobal20/Global" xmlns:y29="http://0010829675-one-off.sap.com/Y296E4FLY_" xmlns:ydq="http://0010829675-one-off.sap.com/YDQF8U7FY_" xmlns:a1y="http://sap.com/xi/AP/CustomerExtension/BYD/A1YHI">
   <soapenv:Header/>
  <soapenv:Body>
      <glob:MarketingLeadBundleMaintainRequest_sync>
         <BasicMessageHeader/>
         <!--1 or more repetitions:-->
         <MarketingLead actionCode="01" itemListCompleteTransmissionIndicator="true">
            <Name>Leads from Prestige Construction Website </Name>
            <!--Variable Mandatory-->
            <OriginTypeCode>Z07</OriginTypeCode>
            <!--constant value for website-->
            <StatusCode>01</StatusCode>
            <!--constant-->
            <Note>'.$message.'</Note>
            <!--Add the details coming from CF-->
            <EmployeeInternalID>102987</EmployeeInternalID>
            <!--Mandatory 99999-->
            <UseExistingAccountContactIndicator>true</UseExistingAccountContactIndicator>
            <SalesEmployeeResponsibleInternalID>102987</SalesEmployeeResponsibleInternalID>
            <!--Constant-->
            <!--Optional:-->
            <ProspectParty>
               <AccountInternalID>'.$clientid.'</AccountInternalID>
               <!--Account ID generated on step 1 or step 2-->
               <!--Optional:-->
            </ProspectParty>
            <!--Optional:-->
            <a1y:PreferredProject>'.$pid.'</a1y:PreferredProject>
            <!--Attached File-->
            <!--Optional:-->
            <a1y:LeadType>101</a1y:LeadType>
            <!--Attached File-->
            <!--Optional:-->
            <a1y:Website>www.prestigeconstructions.com</a1y:Website>
            <!--Constant for CF-->
            <!--Optional:-->
            
         </MarketingLead>
      </glob:MarketingLeadBundleMaintainRequest_sync>
   </soapenv:Body>
</soapenv:Envelope>';

return $xml;

endif;
}

function Createcustomer($accountName = '', $email = '', $phoneNumber = ''){
    $xml = '<ns1:CustomerBundleMaintainRequest_sync_V1>
 <Customer actionCode="01">
            
            <CategoryCode>1</CategoryCode>
            <ProspectIndicator>false</ProspectIndicator>
            <CustomerIndicator>true</CustomerIndicator>
            <LifeCycleStatusCode>2</LifeCycleStatusCode>
            <PartyRoleCode>142</PartyRoleCode>

            <!--Optional:-->
            <Person>
               <!--Optional:-->
               <FamilyName>'.$accountName.'</FamilyName>
            </Person>
            <AddressInformation actionCode="01" addressUsageListCompleteTransmissionIndicator="true">
               <!--Optional:-->
               <!--Zero or more repetitions:-->
               <!--Optional:-->
               <Address actionCode="01" telephoneListCompleteTransmissionIndicator="true">
                  <!--Optional:-->
                  <!--Optional:-->
                  <Email>
                     <!--Optional:-->
                     <URI schemeID="?">'.$email.'</URI>
                     <!--Optional:-->
                  </Email>
                  <PostalAddress>
                     <!--Optional:-->
                     <CountryCode>IN</CountryCode>
                     <!--Optional:-->
                     <CountyName>India</CountyName>
                     <!--Optional:-->
                     <CityName>Bangalore</CityName>
                  </PostalAddress>
                  <!--Zero or more repetitions:-->
                  <Telephone>
                     <!--Optional:-->
                     <FormattedNumberDescription>+91 '.$phoneNumber.'</FormattedNumberDescription>
                     <!--Optional:-->
                     <MobilePhoneNumberIndicator>true</MobilePhoneNumberIndicator>
                  </Telephone>
                  <!--Optional:-->
               </Address>
            </AddressInformation>
            <DuplicateCheckApplyIndicator>false</DuplicateCheckApplyIndicator>
            <!--Optional:-->
         </Customer>
</ns1:CustomerBundleMaintainRequest_sync_V1>';
    return $xml;
}


function xmlCustomerSearch($email){
    $xml = '<n0:CustomerByCommunicationDataQuery_sync xmlns:n0="http://sap.com/xi/SAPGlobal20/Global">
   <CustomerSelectionByCommunicationData>
            <SelectionByEmailURI>
               <!--Optional:-->
               <InclusionExclusionCode>I</InclusionExclusionCode>
               <!--Optional:-->
               <IntervalBoundaryTypeCode>1</IntervalBoundaryTypeCode>
               <!--Optional:-->
               <LowerBoundaryEmailURI>'.$email.'</LowerBoundaryEmailURI>
            </SelectionByEmailURI>

         </CustomerSelectionByCommunicationData>
         <!--Optional:-->
         <ProcessingConditions>
            <!--Optional:-->
            <QueryHitsMaximumNumberValue>10</QueryHitsMaximumNumberValue>
            <QueryHitsUnlimitedIndicator>false</QueryHitsUnlimitedIndicator>
            <!--Optional:-->
         </ProcessingConditions>
</n0:CustomerByCommunicationDataQuery_sync>';
    return $xml;
}


