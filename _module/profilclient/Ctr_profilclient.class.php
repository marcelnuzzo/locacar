<?php
class Ctr_profilclient extends Ctr_controleur {
	
	public function __construct($action) {
        parent::__construct("profilclient", $action);  
		$this->table="client";
        $this->classTable = "Client";
        $this->cle = "cli_id";
        $a = "a_$action";
        $this->$a();
    }	
	
	function a_index() {
		//$result=Client::selectAll("client");
		$result = Location::liste();
		require $this->gabarit;
	}
	
	function a_reservation() {
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Location($id);
		$date_debut=date("Y-m-d");
		$heure_debut=date("H:i");
		$date_fin=date("Y-m-d");
		$heure_fin=date("H:i");
		$taboption=Options::selectAll("options");
		$jsonoption=json_encode($taboption->fetchAll(PDO::FETCH_ASSOC));
		require $this->gabarit;
	}

	//$_POST : enregistrement à sauver
	function a_test() {
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
	
	//affche la liste des agences par département pour le client
	function a_indexAge() {
		$result=Departement::listeDepCli();
		require $this->gabarit;
	}
	
	//affiche la liste des catégories pour le client
	function a_indexCat() {
		$result=Categorie::selectAll("categorie");
		require $this->gabarit;
	}
	
	//affiche la liste des options des voitures pour le client
	function a_indexOpt() {
		$result=Options::selectAll("options");
		require $this->gabarit;
	}
	
	function a_edit() {
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Client($_SESSION["cli_id"]);
		extract($u->data);	
		require $this->gabarit;
	}
	
	function a_inscription() {
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Client();//($_SESSION["cli_id"]);
		extract($u->data);	
		require $this->gabarit;
	}
	
	function a_save() {
		if (isset($_POST["btSubmit"])) {
			$_POST["cli_mdp"]=password_hash($_POST["cli_mdp"], PASSWORD_DEFAULT);
			$u=new Client();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
		}
		
			header("location:index.php?m=profilclient");
		
	}
	
		//$_POST : mot de passe à sauver
	function a_sauvermotdepasse () {
		if (isset($_POST["btSubmit"])) {
			$_POST["cli_mdp"] = password_hash($_POST["cli_mdp"],PASSWORD_DEFAULT);	
			$u=new client();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
			 }
		header("location:" . hlien("profilclient", "index"));
		}
		   public function a_modifiermotdepasse() {

        require $this->gabarit;
    }
	
	function a_historique() {
		$result=Location::historiquelocations($_SESSION["cli_id"]);
		require $this->gabarit;

	}
	
	//affche mes locations en cours
	function a_locencours() {
		$result=Location::locationsencours($_SESSION["cli_id"]);
		require $this->gabarit;

	}
	
		//affche mes locations à venir
	function a_locavenir() {
		$result=Location::locationsavenir($_SESSION["cli_id"]);
		require $this->gabarit;

	}
	
		//affche toutes mes locations
	function a_toutesMesLoc() {
		$result=Location::toutesMesLoc($_SESSION["cli_id"]);
		require $this->gabarit;

	}
	
	//affiche la liste des véhicules disponibles
	function a_dispovehicule() {
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

	function a_ajaxaffichervehiculedispo() {
		extract($_GET);
		$resultvehiculedispo = Vehicule::vehiculeDispoCatAge($age_id,$cat_id,$fin,$debut);
		if ($resultvehiculedispo->rowCount()>0) {
			while ($row=$resultvehiculedispo->fetch(PDO::FETCH_ASSOC)) {
				echo "<li>" . $row['cat_nom'] . " n°" . $row['veh_id'] . " " . $row['veh_marque'] . " (" . $row['age_nom'] . ")" . "</br>";
			}
		} else {
			echo "Auncun véhicule disponible pour cette catégorie aux dates indiquées" . "</br>" . "<button onclick='autre()'>" . "Voir les véhicules disponibles appartenant aux autres catégories" . "</button>";
		}
	}

	function a_ajaxautrevehiculedispo() {
		extract($_GET);
		$resultvehiculedispoage = Vehicule::vehiculeDispoAge($age_id,$fin,$debut);
		while ($tab=$resultvehiculedispoage->fetch(PDO::FETCH_ASSOC)) {
			echo "<li>" . $tab['cat_nom'] . " n°" . $tab['veh_id'] . " " . $tab['veh_marque'] . " (" . $tab['age_nom'] . ")" . "</br>";
		}
	}
	
	//$_POST : enregistrement à sauver
	function a_saveLoc() {
		if (isset($_POST["btSubmit"])) {
			if ($_POST["loc_vehicule"]==0) {
				$_POST["loc_vehicule"]=null;
			}
			$_POST["loc_date_debut"]=$_POST["date_debut"] . " " . $_POST["heure_debut"];
			$_POST["loc_date_fin"]=$_POST["date_fin"] . " " . $_POST["heure_fin"];
			if (!self::validateDate($_POST["loc_date_debut"],"Y-m-d H:i") or !self::validateDate($_POST["loc_date_fin"],"Y-m-d H:i") ) {
				$_SESSION["msgerreur"]="Vous n'avez pas saisie une date valide". $_POST["loc_date_debut"];
				header("location:" . hlien("profilclient","demande","id",$_POST["loc_id"]));				
			} else {	
				$u=new Location();
				$u->chargerDepuisTableau($_POST);
				$u->sauver();
				foreach ($_POST as $cle=>$valeur) {
					if (strpos($cle,"select")===0) {
						$this->newoption($u->data["loc_id"],$valeur);
					}
				}
				header("location:" . hlien("profilclient","index"));
			}
		} else
			header("location:" . hlien("profilclient","index"));				
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_demande() {
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
			$loc_date = utf8_encode(strftime("%A %d %B %Y %H:%M",strtotime($loc_date)));
			$resultOption = Location::listeOption($id);
		} else {
			$date_debut=date("Y-m-d");
			$heure_debut=date("H:i");
			$date_fin=date("Y-m-d");
			$heure_fin=date("H:i");
			$loc_statut="Initialisé";
			$loc_date = utf8_encode(strftime("%A %d %B %Y %H:%M",strtotime($loc_date)));
		}
		$taboption=Options::selectAll("options");
		$jsonoption=json_encode($taboption->fetchAll(PDO::FETCH_ASSOC));
		require $this->gabarit;
	}
	
	static function validateDate($date, $format = 'Y-m-d H:i:s')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
	
	function newoption($con_location,$con_option) {
		$obj=new Contenir();
		$tab["con_id"]=0;
		$tab["con_location"]=$con_location;
		$tab["con_options"]=$con_option;
		$obj->chargerDepuisTableau($tab);
		$obj->sauver();
	}
	
}
?>