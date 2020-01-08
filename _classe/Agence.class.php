<?php
class Agence extends Entity {
	public function __construct($id=0) {
		parent::__construct("agence", "age_id",$id);
	}
	
	static public function liste() {
		$sql="select * from agence,departement where age_departement=dep_id order by age_id";
		return self::$link->query($sql);
	}
	
	//liste des agences pour le client anonyme
	static public function listeAge($dep_id) {
		$sql="select * from agence where age_departement=$dep_id";
		return self::$link->query($sql);
	}
	
	//liste des véhicules disponibles
	static function listeVehDispo($ges_agence,$tri="veh_id") {
		$sql="select * from vehicule,agence,gestionnaire,location,categorie where cat_id=veh_categorie and ges_id=loc_gestionnaire and loc_vehicule=veh_id and veh_agence=age_id and ges_agence=$ges_agence and veh_id not in (select loc_vehicule from location where now() between loc_date_debut and loc_date_fin) order by $tri";
		return self::$link->query($sql);
	}
	
	static function listeVoitureDispo() {
		$sql="select * from vehicule,agence,gestionnaire,location,categorie where cat_id=veh_categorie and ges_id=loc_gestionnaire and loc_vehicule=veh_id and veh_agence=age_id  and veh_id not in (select loc_vehicule from location where now() between loc_date_debut and loc_date_fin) ";
		return self::$link->query($sql);
	}
	
}
?>
