	<?php
	if (isset($_SESSION["msgerreur"])) {
		echo $_SESSION["msgerreur"];
		unset($_SESSION["msgerreur"]);
	}
	?>
		<h2><?=$loc_id ? "Modification de la location n°$loc_id" : "Ajouter une nouvelle location"?></h2>
		<form method="post" action="<?=hlien("location","save")?>" onsubmit="return go()">
			<input type="hidden" name="loc_id" id="loc_id" value="<?= $id ?>" />
			<div class='form-group'>
				<label for='date_debut'>Date de début :</label>
				<input id='date_debut' name='date_debut' type='date' value='<?=$date_debut?>' onchange='modifyDate()' required />
				<label for='heure_debut'>Heure de début :</label>
				<input id='heure_debut' name='heure_debut' type='time' onchange='appelAjax()' value='<?=$heure_debut?>' required />
			</div>
			<div class='form-group'>
				<label for='date_fin'>Date de fin :</label>
				<input id='date_fin' name='date_fin' type='date' value='<?=$date_fin?>' onchange='alertDate' required />
				<label for='heure_fin'>Heure de début :</label>
				<input id='heure_fin' name='heure_fin' type='time' value='<?=$heure_fin?>' onchange='alertDate()' required />
			</div>
			<div class='form-group'>
				<label for='loc_age_depart'>Agence de départ :</label>
				<select id='loc_age_depart' name='loc_age_depart' >
				<?=Entity::HTMLselect("select age_id id, age_nom label from agence",$loc_age_depart)?>
				</select>
			</div>
			<div class='form-group'>
				<label for='loc_age_arrivee'>Agence d'arrivée :</label>
				<select id='loc_age_arrivee' name='loc_age_arrivee'  >
				<?=Entity::HTMLselect("select age_id id, age_nom label from agence",$loc_age_arrivee)?>
				</select>
			</div>
			<div class="form-group row">
				<p>État de la demande :</p>
					<label for="radio_annule">Annulé</label>
					<input type="radio" id="radio_annule" name="loc_statut" value="Annulé" <?=($loc_statut=="Annulé")? "checked":""?> />
					<label for="radio_initialise">Initialisé</label>
					<input type="radio" id="radio_initialise" name="loc_statut" value="Initialisé" <?=($loc_statut=="Initialisé")? "checked":""?> />
					<label for="radio_valide">Validé</label>
					<input type="radio" id="radio_valide" name="loc_statut" value="Validé" <?=($loc_statut=="Validé")? "checked":""?> />
			</div>
			<div class='form-group'>
				<label for='loc_client'>Nom du client :</label>
				<select id='loc_client' name='loc_client' >
				<?=Entity::HTMLselect("select cli_id id, cli_nom label from client",$loc_client)?>
				</select>
			</div>
			<div class='form-group'>
				<label for='loc_gestionnaire'>Nom du gestionnaire :</label>
				<select id='loc_gestionnaire' name='loc_gestionnaire' >
				<?=Entity::HTMLselect("select ges_id id, ges_nom label from gestionnaire",$loc_gestionnaire)?>
				</select>
			</div>
			<div class='form-group'>
				<label for='loc_categorie'>Nom de la catégorie :</label>
				<select id='loc_categorie' name='loc_categorie' onchange="calcultarif()" >
				<?=Entity::HTMLselect("select cat_id id, cat_nom label from categorie",$loc_categorie)?>
				</select>
			</div>
			<div class='form-group'>
				<label for='loc_vehicule'>Nom du véhicule :</label>
				<select id='loc_vehicule' name='loc_vehicule' >
				<option value="0">Aucun véhicule</option>
				<?=Entity::HTMLselect("select veh_id id, veh_immatriculation label from vehicule",$loc_vehicule)?>
				</select>
			</div>
			<div class='form-group' id="divoption">
			<?php if ($id>0) { ?>
			<h3>Liste des options demandées :</h3>
			<?php 
			foreach($resultOption as $row) { ?>
			<p>
			<input type="hidden" value="<?=$row["opt_id"]?>">
			<?=$row["opt_id"]?> - <?=$row["opt_nom"]?> - 
			<a class="btn btn-danger" href="<?=hlien("location","desequiper","con_id",$row["con_id"],"loc_id",$id)?>">Supprimer</a>
			</p>
		<?php } ?>
		<?php } ?>
				<div id="espace_ajoutOption"></div>
				<button type="button" id="btAjouterOption" onclick="btAjoutOption()">Ajouter une option supplémentaire</button>
		</div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
		</form>
		<h4>Tarif :</h4>
		<ul>
			<li>Prix de la location (hors options) : <span id="resultatprixhorsoption"></span> €</li>
			<li>Prix de (ou des) option(s) : <span id="resultatprixoption"></span> €</li>
			<li>Prix total : <span id="resultattotal"></span> €</li>
		</ul>
		</p>
		<div id="resultat"></div>
	<script src="_js/equipement.class.js"></script>
<script>

let prix_option;
let tarif;


//initialisation du tableau json
var loc_option=<?=$jsonoption?>;

//idratation de l'objet à partir de la classe équipement dans le dossier.js
var cpt=1;
function btAjoutOption() {
	new Equipement("a1",espace_ajoutOption,"Choix des options",cpt++);
}

//update instannée et réciproque des deux inputs dates (debut et fin)
function modifyDate() {
	if (document.getElementById("loc_id").value==0) {
		let date_fin=document.getElementById("date_fin")
		date_fin.value=document.getElementById("date_debut").value
		let heure_fin=document.getElementById("heure_fin")
		heure_fin.value=document.getElementById("heure_debut").value
	}
}

//creation d'une alerte sur le bouton submit afin de permettre d'informer l'utilisateur d'une mauvaise saisie des dates
function go() {
	let fin = document.getElementById("date_fin").value + " " + document.getElementById("heure_fin").value
	let debut = document.getElementById("date_debut").value + " " + document.getElementById("heure_debut").value
	if (fin<debut) {
		alert("Attention! La date de fin saisie est antérieure à la date de début.");
		return false;
	} else {
	return true;
	}
}

//fonction pour initialiser l'appel ajax
function getXmlhttp() {
	if (window.XMLHttpRequest)
		return new XMLHttpRequest();
	else if (window.ActiveXObject)
		return new ActiveXObject("Msxml2.XMLHTTP");
	else
		throw new Error("Could not create HTTP request object.");
}

//function ajax pour calculer le tarif (hors options) d'ne location
function calcultarif() {
	var xmlhttp;
	//récupération de la date de début et de la date de fin
	let fin = date_fin.value + " " + heure_fin.value
	let debut = date_debut.value + " " + heure_debut.value
	//calcul de la durée (en heures) d'une location à partir des deux dates récupérées
	date1 = new Date(debut)
	date2 = new Date(fin)
	var diffEnMilliseconde = date2-date1
	var diffEnHeures = ((date2-date1)/1000)/3600
	//creation du paramètre
	var para="cat="+loc_categorie.value + "&" + "nbh=" + diffEnHeures;
	xmlhttp= getXmlhttp();
	xmlhttp.open("GET","http://kevin/locacar/www/index.php?m=location&a=ajaxcalcultarif&" + para,true);
	xmlhttp.onreadystatechange=mafonction;
	xmlhttp.send();
	
	function mafonction() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("resultatprixhorsoption").innerHTML += xmlhttp.responseText;
			tarif=xmlhttp.responseText;
		}
	}
}

//function pour calculer le montant du (ou des) option(s) sélectionnée(s)
function calculoption() {
	let tab = document.querySelectorAll("#divoption select,#divoption input");
	let x = 0;
	for (let i=0;i<tab.length;i++) {
		let k = tab[i].value;
		x += parseInt(loc_option[k-1].opt_prix);
	}
	document.getElementById("resultatprixoption").innerHTML += x;
	prix_option=x;
}


function prixtotal() {
	total = parseInt(prix_option) + parseInt(tarif);
	document.getElementById("resultattotal").innerHTML += total;
}

calculoption();
calcultarif();

</script>