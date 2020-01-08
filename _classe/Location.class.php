<?php
class Location extends Entity {
	public function __construct($id=0) {
		parent::__construct("location", "loc_id",$id);
	}
	/*
	create view location_vehicule as select * from location left join vehicule on loc_vehicule=veh_id
	*/
	static public function liste() {
	$sql="select depart.age_id agedepartid,depart.age_nom agedepart,arrivee.age_id agefinid,arrivee.age_nom agefin,cli_id,cli_nom,ges_id,ges_nom,loc_id,loc_date_debut,loc_date_fin,loc_age_depart,loc_age_arrivee,loc_statut,loc_client,loc_gestionnaire,loc_date,loc_vehicule,veh_id,veh_immatriculation,cat_nom from agence depart,agence arrivee,client,gestionnaire,location_vehicule,categorie where loc_age_depart=depart.age_id and loc_age_arrivee=arrivee.age_id and loc_client=cli_id and loc_gestionnaire=ges_id and loc_categorie=cat_id order by loc_id";
	return self::$link->query($sql);
	}
	
	/*
	create view loc_duree as select loc_id,timestampdiff(hour,loc_date_debut,loc_date_fin) duree,veh_categorie from location, vehicule where loc_vehicule=veh_id
	*/
	
	static public function locationInitialise() {
		$sql="select * from location_vehicule where loc_statut='Initialisé' order by loc_id,loc_date";
		return self::$link->query($sql);
	}
	
	static function montantLocation($loc_id) {
		$sql="select loc_id, tar_thj*duree prix_hors_option from loc_duree,plage_horaire,tarif where veh_categorie=tar_categorie and loc_id=$loc_id and pla_id=tar_pla and duree between pla_hmin and pla_hmax";
		return self::$link->query($sql);
	}
	
	static function montantLocationAjax($cat,$nbh) {
		$sql="select tar_thj*$nbh prix_hors_option from plage_horaire,tarif where tar_categorie=$cat and pla_id=tar_pla and $nbh between pla_hmin and pla_hmax";
		return self::$link->query($sql);
	}
	
	static function listeOption($loc_id) {
		$sql="select opt_id, opt_nom, con_id from options,contenir where opt_id=con_options and con_location=$loc_id order by opt_id";
		return self::$link->query($sql);
	}
	
	
	static function montantOption($loc_id) {
		$sql="select  con_location,sum(opt_prix) prixoption from options,contenir where con_options=opt_id and con_location=$loc_id group by con_location";
		return self::$link->query($sql);
	}
	
	static function deleteLocation($loc_id) {
		$sql="delete from contenir where con_location=$loc_id";
		return self::$link->query($sql);
	}
	
	//requête pour compter le nombre de location annulée
	static function nbLocationAnnuleSrc($age_id) {
		$sql="select age_id,age_nom,count(loc_id) nbannule from location_vehicule,agence where loc_age_depart=age_id and loc_age_depart=$age_id and loc_statut='Annulé' group by age_id";
		return self::$link->query($sql);
	}
	
	static function nbLocationInitialiseSrc($age_id) {
		$sql="select age_id,age_nom,count(loc_id) nbinitialise from location_vehicule,agence where loc_age_depart=age_id and loc_age_depart=$age_id and loc_statut='Initialisé' group by age_id";
		return self::$link->query($sql);
	}
	
	static function nbLocationValideSrc($age_id) {
		$sql="select age_id,age_nom,count(loc_id) nbvalide from location_vehicule,agence where loc_age_depart=age_id and loc_age_depart=$age_id and loc_statut='Validé' group by age_id";
		return self::$link->query($sql);
	}
	
	
	static function listeLocation() {
		$sql="select cli_id,cli_nom,cli_prenom,cli_mail,depart.age_id agedepartid,depart.age_nom agedepart,arrivee.age_id agefinid,arrivee.age_nom agefin,cli_id,ges_id,ges_nom,ges_prenom,ges_mail,loc_id,loc_date_debut,loc_date_fin,loc_age_depart,loc_age_arrivee,loc_statut,loc_client,loc_gestionnaire,loc_vehicule,veh_id,veh_immatriculation,cat_nom from agence depart,agence arrivee,client,gestionnaire,location_vehicule,categorie where loc_age_depart=depart.age_id and loc_age_arrivee=arrivee.age_id and loc_client=cli_id and loc_gestionnaire=ges_id and loc_age_depart=1 and veh_categorie=cat_id and loc_statut='Initialisé' order by loc_id";
		return self::$link->query($sql);
	}
	
	static function listeLocationAgence($age_id,$statut) {
		$sql="select * from location_vehicule where loc_age_depart=$age_id and loc_statut=$statut";
		return self::$link->query($sql);
	}
	
	static function historiquelocations($cli_id) {
		$sql="select * from location,client, categorie , vehicule, agence where cli_id=loc_client and loc_categorie=cat_id and loc_vehicule=veh_id and veh_agence=age_id and loc_client=$cli_id and loc_date_fin<now() ";
		return self::$link->query($sql);
	}
	
	static function locationsencours($cli_id) {
		$sql="select * from location,client, categorie, vehicule where cli_id=loc_client and loc_client=$cli_id and loc_categorie=cat_id and veh_id=loc_vehicule and now() between loc_date_debut and  loc_date_fin ";
		return self::$link->query($sql);

	}
	
	static function locationsavenir($cli_id) {
		$sql="select * from location,client, categorie , vehicule, agence where cli_id=loc_client and loc_categorie=cat_id and loc_vehicule=veh_id and veh_agence=age_id and loc_client=$cli_id and loc_date_debut>now()";
		return self::$link->query($sql);
	}
	
	static function toutesMesLoc($cli_id) {
		$sql="select * from location,client, categorie , vehicule, agence where cli_id=loc_client and loc_categorie=cat_id and loc_vehicule=veh_id and veh_agence=age_id and loc_client=$cli_id";
		return self::$link->query($sql);
	}

	}
?>