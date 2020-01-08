<?php

class Ctr_src extends Ctr_controleur {

    public function __construct($action) {
        parent::__construct("src", $action);
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$result=Agence::liste();
		$resultannule=Location::nbLocationAnnuleSrc();
		$resultinitialise=Location::nbLocationInitialiseSrc();
		$resultvalide=Location::nbLocationValideSrc();
		require $this->gabarit;
	}
	
	function a_initialise() {
		$initialise = Location::listeLocation();
		require $this->gabarit;
	}
}
?>