<?php

class MWD_SoapService {
   protected $logger;

   public function __construct($logger) {
      $this->logger=$logger;
   }

	/**
	 * hello
	 * 
	 * @return string
	 */
	public function hello() {
      return "Hello World";
	}
	/**
	 * hello2
	 * 
    * @param string $fname
    * @param string $lname
	 * @return string
	 */
	public function hello2($fname, $lname) {
      return "Hello $fname $lname";
	}
}
