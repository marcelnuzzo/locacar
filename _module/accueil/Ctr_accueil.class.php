<?php
class Ctr_accueil extends Ctr_controleur {
	
	public function __construct($action) {
        parent::__construct("accueil", $action);        
        $a = "a_$action";
        $this->$a();
    }
	
	function a_index() {	
		$result=Agence::listeVoitureDispo();
		require $this->gabarit;
	}
}
?>