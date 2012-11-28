<?php
ini_set("soap.wsdl_cache_enabled", "0");
require_once('../common.php');

// setup Soap CLient
$client = new Zend_Soap_Client_DotNet('http://198.101.220.77/SoapServer/doc/server.php?wsdl');

echo var_dump($client->hello());
echo var_dump($client->hello2(array("fname" => "Joe", "lname" => "Smith")));
