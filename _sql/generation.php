<?php
require "../_include/inc_config.php";

// I. Initialisation des variables
$nbcategorie="6";
$nbclient="100";
$nbagence="20";
$nbgestionnaire="51";
$nbvehicule="200";
$nblocation="70";


//Insertion des clients
	$sql="insert into client values (null,:nom,:prenom,:adresse,:mail,:mdp)";
	$statement = $link->prepare($sql);
	
	for($i=1;$i<=$nbclient;$i++) {
		$statement->bindValue(":nom","nom client $i",PDO::PARAM_STR);
		$statement->bindValue(":prenom","prenom client $i",PDO::PARAM_STR);
		$statement->bindValue(":adresse","adresse client $i",PDO::PARAM_STR);
		$statement->bindValue(":mail","mail client $i",PDO::PARAM_STR);
		$statement->bindValue(":mdp","mdp client $i",PDO::PARAM_STR);
		$statement->execute();
	}

//Insertion des agences
	$sql="insert into agence values (null,:nom,:adresse,:departement)";
	$statement = $link->prepare($sql);
	for($i=1;$i<=$nbagence;$i++) {
		$statement->bindValue(":nom","nom agence $i",PDO::PARAM_STR);
		$statement->bindValue(":adresse","adresse agence $i",PDO::PARAM_STR);
		$statement->bindValue(":departement","$i",PDO::PARAM_INT);
		$statement->execute();
	}
	
	
//Insertion des gestionnaires
	$agence=NULL;
	$cpt=1;
	$sql="insert into gestionnaire values (null,:nom,:prenom,:mail,:mdp,:profil,:agence)";
	$statement = $link->prepare($sql);
	for($i=1;$i<=$nbgestionnaire;$i++) {
		$statement->bindValue(":nom","nom gestionnaire $i",PDO::PARAM_STR);
		$statement->bindValue(":prenom","prenom gestionnaire $i",PDO::PARAM_STR);
		$statement->bindValue(":mail","mail gestionnaire $i",PDO::PARAM_STR);
		$statement->bindValue(":mdp","mdp gestionnaire $i",PDO::PARAM_STR);
		
		if($i<=1)
			$profil="admin";
		else if($i>1 and $i<=11)
			$profil="src";
		else if($i>11) 
			$profil="gestion";
		
		$statement->bindValue(":profil",$profil,PDO::PARAM_STR);
		
		if($profil=="gestion") {
			$agence=$cpt;
			$cpt++;
			if($cpt>20)
				$cpt=1;
		}
		else {
			$agence=null;
		}
		$statement->bindValue(":agence",$agence,PDO::PARAM_INT);
		$statement->execute();
	}
	
//Insertion des véhicules
	$tab=["Renault",
		"Peugeot",
		"Citroen",
		"lada",
		"Ferrari",
		"Burstner",
		"Jaguar",
		"Fiat",
		"Bentley",
		"Ford"];
	$imma=100;
	$categorie=1;
	$agence=1;
	$j=0;
	$sql="insert into vehicule values (null,:marque,:immatriculation,:agence,:categorie)";
	$statement = $link->prepare($sql);
	for($i=1;$i<=$nbvehicule;$i++) {
		if($j>=10)
			$j=0;
		$statement->bindValue(":marque","$tab[$j]",PDO::PARAM_STR);
		$statement->bindValue(":immatriculation","$imma",PDO::PARAM_STR);
		if($agence>20)
			$agence=1;
		$statement->bindValue(":agence","$agence",PDO::PARAM_INT);
		if($categorie>6)
			$categorie=1;
		$statement->bindValue(":categorie","$categorie",PDO::PARAM_INT);
		$statement->execute();
		$imma++;
		$agence++;
		$categorie++;
		$j++;
	}
	

//Insertion des locations
	$sql="insert into location values (null,:date_debut,:date_fin,:age_depart,:age_arrivee,:statut,:client,:gestionnaire,:categorie,:vehicule,:date)";
	$statement = $link->prepare($sql);
	for($i=1;$i<=$nblocation;$i++) {
		//création des dates aléatoires
		$debut=mktime(mt_rand(7,22),0,0,mt_rand(1,12),mt_rand(1,30),2019);
		//calcul de la date aléatoire de fin de location
		$temps=mt_rand(1,12410)*3600;
		//cohérence des heures d'ouverture et de fermeture
		$fin=$debut + $temps;
		$h=date("H",$fin);
		if($h<7) 
			$h=07;
		else if($h>21) 
			$h=22;
			$debut=date("Y-m-d H:i:s",$debut);
			$fin=date("Y-m-d H:i:s",$fin);		
			$date=date("Y-m-d $h:i:s");		
		//l'agence de départ et d'arrivée sont tirées au hasard
		$agence_depart=mt_rand(1,$nbagence);
		$agence_arrivee=mt_rand(1,$nbagence);
		//le statut de la demande, l'agent, le client et le véhicule sont tirés au hasard
		$tab=array("Validé","Annulé");
		$index_statut=array_rand($tab,1);
		if($fin < date("Y-m-d H:i:s",time()))
			$statut="Terminé";
		else if($debut > date("Y-m-d H:i:s",time()))
			$statut="Initialisé";
		else if($debut < date("Y-m-d H:i:s",time()) and date("Y-m-d H:i:s",time()) < $fin)
			$statut=$tab[$index_statut];
		//$statut=$tab[$index_statut];
		$gestionnaire=mt_rand(1,$nbgestionnaire);
		$client=mt_rand(1,$nbclient);
		$categorie=mt_rand(1,$nbcategorie);
		$vehicule=mt_rand(1,$nbvehicule);
		$statement->bindValue(":date_debut",$debut,PDO::PARAM_STR);
		$statement->bindValue(":date_fin",$fin,PDO::PARAM_STR);
		$statement->bindValue(":age_depart",$agence_depart,PDO::PARAM_INT);
		$statement->bindValue(":age_arrivee",$agence_arrivee,PDO::PARAM_INT);
		$statement->bindValue(":statut",$statut,PDO::PARAM_STR);
		$statement->bindValue(":client",$client,PDO::PARAM_INT);
		$statement->bindValue(":gestionnaire",$gestionnaire,PDO::PARAM_INT);
		$statement->bindValue(":categorie",$categorie,PDO::PARAM_INT);
		$statement->bindValue(":vehicule",$vehicule,PDO::PARAM_INT);
		$statement->bindValue(":date",$date,PDO::PARAM_STR);
		$statement->execute();
	}


//Insertion dans contenir 
	$options=1;
	$location=1;
	$sql="insert into contenir values (null,:options,:location)";
	$statement = $link->prepare($sql);
	for($i=1;$i<=70;$i++) {
		if($options>5)
			$options=1;
		$statement->bindValue(":options","$options",PDO::PARAM_INT);
		if($location>70)
			$location=1;
		$statement->bindValue(":location","$location",PDO::PARAM_INT);
		$statement->execute();
		$options++;
		$location++;
	}	
	
?>
<h2>Génération terminée</h2>
<?php
echo $debut;
echo "</br>";
echo $fin;
echo "</br>";
echo date("Y-m-d H:i:s",time());
echo "</br>";
echo $temps/(3600*24*30);
echo "</br>";