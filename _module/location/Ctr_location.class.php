<?php

class Ctr_location extends Ctr_controleur {

    public function __construct($action) {
        parent::__construct("location", $action);
        $this->table="location";
        $this->classTable = "Location";
        $this->cle = "loc_id";
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$result = Location::liste();
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Location($id);
		extract($u->data);	
		if ($id>0) {
			$tsDebut=strtotime($loc_date_debut);
			$date_debut=date("Y-m-d",$tsDebut);
			$heure_debut=date("H:i",$tsDebut);
			$tsFin=strtotime($loc_date_fin);
			$date_fin=date("Y-m-d",$tsFin);
			$heure_fin=date("H:i",$tsFin);
			$resultOption = Location::listeOption($id);
		} else {
			$date_debut=date("Y-m-d");
			$heure_debut=date("H:i");
			$date_fin=date("Y-m-d");
			$heure_fin=date("H:i");
			$loc_statut="Validé";
			$loc_date=date("Y-m-d H:i:s");
		}
		$taboption=Options::selectAll("options");
		$jsonoption=json_encode($taboption->fetchAll(PDO::FETCH_ASSOC));
		require $this->gabarit;
	}

	//$_POST : enregistrement à sauver
	function a_save() {
		if (isset($_POST["btSubmit"])) {
			if ($_POST["loc_vehicule"]==0) {
				$_POST["loc_vehicule"]=null;
			}
			$_POST["loc_date_debut"]=$_POST["date_debut"] . " " . $_POST["heure_debut"];
			$_POST["loc_date_fin"]=$_POST["date_fin"] . " " . $_POST["heure_fin"];
			if (!self::validateDate($_POST["loc_date_debut"],"Y-m-d H:i") or !self::validateDate($_POST["loc_date_fin"],"Y-m-d H:i") ) {
				$_SESSION["msgerreur"]="Vous n'avez pas saisie une date valide". $_POST["loc_date_debut"];
				header("location:" . hlien("location","edit","id",$_POST["loc_id"]));				
			} else {	
				$u=new Location();
				$u->chargerDepuisTableau($_POST);
				$u->sauver();
				foreach ($_POST as $cle=>$valeur) {
					if (strpos($cle,"select")===0) {
						$this->newoption($u->data["loc_id"],$valeur);
					}
				}
				header("location:" . hlien("location","index"));
			}
		} else
			header("location:" . hlien("location","index"));				
	}
	
	function newoption($con_location,$con_option) {
		$obj=new Contenir();
		$tab["con_id"]=0;
		$tab["con_location"]=$con_location;
		$tab["con_options"]=$con_option;
		$obj->chargerDepuisTableau($tab);
		$obj->sauver();
	}
	
	function a_desequiper() {
		Contenir::supprimer("contenir","con_id",$_GET["con_id"]);
		header("location:" . hlien("location","edit","id",$_GET["loc_id"]));
	}
	
	//param GET id 
	function a_del() {
		if (isset($_GET["id"])) {
			Location::deleteLocation($_GET["id"]);
			Location::supprimer("location","loc_id",$_GET["id"]);
		}
		header("location:index.php?m=location");
	}
	
	//Ajoute un 0 devant des nombers < 10
	function ajouterZero($s) {
		return ($s<10)? "0" . $s : $s;
	}
	
	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
	
	function a_ajaxcalcultarif() {
		extract($_GET);
		$result = Location::montantLocationAjax($cat,$nbh);
		$row=$result->fetch(PDO::FETCH_ASSOC);
		echo $row['prix_hors_option'];
	}
}



?>