<?php  
class Patient {
	public $patid;
	public $patname;
	public $patillness;
	public $patintime;

	public function __construct(){
		$this->patid="";
		$this->patname="";
		$this->patillness="";
		$this->patintime="";
	}

	public function getPatient($patid,$patname,$patillness,$patintime) {
		$this->patid=$patid;
		$this->patname=$patname;
		$this->patillness=$patillness;
		$this->patintime=$patintime;
	}
}


?>