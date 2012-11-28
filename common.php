<?php
$lib=realpath(dirname(__FILE__)).'/lib';
set_include_path(implode(PATH_SEPARATOR, array (
   $lib,
   get_include_path()
)));

require_once 'Zend/Version.php';
if (Zend_Version::compareVersion('1.12.0')) {
   throw new Exception('Server requires ZF1.12.0 and you have '.Zend_Version::VERSION);
}

require_once 'Zend/Loader/StandardAutoloader.php';
$loader=new Zend_Loader_StandardAutoloader(array('autoregister_zf' => true));
$loader->registerPrefix('MWD', $lib.'/MWD');
$loader->register();

// setup logging
$logger = new Zend_Log();
$logger->addWriter(new Zend_Log_Writer_Stream(realpath(dirname(__FILE__)).'/log/logfile', 'a+'));
$logger->registerErrorHandler();
