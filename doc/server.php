<?php
require_once('../common.php');

// requesting the WSDL
if (isset($_GET['wsdl'])) {
   $autodiscover = new Zend_Soap_AutoDiscover('Zend_Soap_Wsdl_Strategy_ArrayOfTypeSequence');
   $autodiscover->setOperationBodyStyle(array('use' => 'literal'));
   $autodiscover->setBindingStyle(array('style' => 'document'));
   $autodiscover->setClass('MWD_SoapService');
   $autodiscover->setUri('http://198.101.220.77/SoapServer/doc/server.php');
   $autodiscover->handle();
   exit(0);
}
// documentation
else if (isset($_GET['doc'])) {
   $xml = new DOMDocument;
   $xml->load('http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'?wsdl');

   $xsl = new DOMDocument;
   $xsl->load('../wsdl-viewer.xsl');

   $proc = new XSLTProcessor;
   $proc->importStyleSheet($xsl);

   echo $proc->transformToXML($xml);
   exit(0);
}

// handle soap requests
$server = new Zend_Soap_Server('http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'?wsdl');
$server->setClass('MWD_SoapService');
$server->setObject(new Zend_Soap_Server_Proxy('MWD_SoapService', array($logger), array('wrappedParts' => true)));
$server->setWsiCompliant(true);
$server->handle();
