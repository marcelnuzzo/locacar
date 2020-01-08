<?php
class Departement extends Entity {
	public function __construct($id=0) {
		parent::__construct("departement", "dep_id",$id);
	}
	
	//liste des départements pour admin
	static public function liste($tri="dep_id") {
		$sql="select * from departement order by $tri";
		return self::$link->query($sql);
	}
	
	//liste des départements pour client anonyme
	static public function listeDepCli() {
		$sql="select distinct dep_id,dep_nom,dep_code from departement,agence where age_departement=dep_id  ";
		return self::$link->query($sql);
	}
}

?>
