<?php
class Vehicule extends Entity {
	public function __construct($id=0) {
		parent::__construct("vehicule", "veh_id",$id);
	}
	
	static public function liste($tri="veh_id") {
		$sql="select * from vehicule, categorie, agence where veh_categorie=cat_id and veh_agence=age_id order by $tri";
		return self::$link->query($sql);
	}
	
	static public function listeCategorieVehicule($cat_id) {
		$sql="select * from vehicule where veh_categorie=$cat_id order by veh_id";
		return self::$link->query($sql);
	}
	
	static public function listeAgenceVehicule($age_id) {
		$sql="select * from vehicule,categorie where veh_categorie=cat_id and  veh_agence=$age_id order by veh_id";
		return self::$link->query($sql);
	}
	
	//requête pour afficher la liste des véhicules disponibles entre 2 dates en fonction de la catégorie sélectionnée
	static function vehiculeDispo($cat_id,$fin,$debut) {
		$sql="select * from vehicule, categorie,agence where veh_categorie=$cat_id and veh_categorie=cat_id and veh_agence=age_id  and veh_id not in (select distinct loc_vehicule from location where (loc_date_debut < '$fin' and loc_date_fin > '$debut'))";
		return self::$link->query($sql);
	}
	
	//requête pour afficher la liste des véhicules disponibles entre 2 dates en fonction de la catégorie sélectionnée et de l'agence départ sélectionnée
	static function vehiculeDispoCatAge($age_id,$cat_id,$fin,$debut) {
		$sql="select * from vehicule,categorie,agence where veh_agence=age_id and veh_agence=$age_id and veh_categorie=cat_id and veh_categorie=$cat_id and veh_id not in (select distinct loc_vehicule from location where (loc_date_debut < '$fin' and loc_date_fin > '$debut'))";
		return self::$link->query($sql);
	}
	
	//requête pour afficher la liste des véhicules disponibles entre 2 dates en fonction de l'agence départ sélectionnée
	static function vehiculeDispoAge($age_id,$fin,$debut) {
		$sql="select * from vehicule,categorie,agence where veh_agence=age_id and veh_agence=$age_id and veh_categorie=cat_id and veh_id not in (select distinct loc_vehicule from location where (loc_date_debut < '$fin' and loc_date_fin > '$debut'))";
		return self::$link->query($sql);
	}
	
	//requête pour afficher la liste des véhicules disponibles entre 2 dates en fonction de la catégorie sélectionnée 
	static function vehiculedispocat($cat_id,$fin,$debut) {
		$sql="select * from vehicule,categorie,agence,departement where veh_agence=age_id and veh_categorie=cat_id and veh_categorie=$cat_id and age_departement=dep_id and veh_id not in (select distinct loc_vehicule from location where (loc_date_debut < '$fin' and loc_date_fin > '$debut'))";
		return self::$link->query($sql);
	}
}
?>
