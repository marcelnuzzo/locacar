	<?php
	if (isset($_SESSION["msgerreur"])) {
		echo $_SESSION["msgerreur"];
		unset($_SESSION["msgerreur"]);
	}
	?>
		<h2><?=$loc_id ? "Modification de la location n°$loc_id" : "Ajouter une nouvelle location"?></h2>
		<form method="post" action="<?=hlien("src","save")?>" onsubmit="return go()">
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
				<select id='loc_categorie' name='loc_categorie' onchange="afficher()" >
				<?=Entity::HTMLselect("select cat_id id, cat_nom label from categorie",$loc_categorie)?>
				</select>
			</div>
			<div class='form-group'>
				<label for='loc_vehicule'>Nom du véhicule :</label>
				<select id='loc_vehicule' name='loc_vehicule' ></select>
			</div>
			<div class='form-group' id="divoption">
			<?php if ($id>0) { ?>
			<h3>Liste des options demandées :</h3>
			<?php 
			foreach($resultOption as $row) { ?>
			<p>
			<input type="hidden" value="<?=$row["opt_id"]?>">
			<?=$row["opt_id"]?> - <?=$row["opt_nom"]?> - 
			<a class="btn btn-danger" href="<?=hlien("src","desequiper","con_id",$row["con_id"],"loc_id",$id)?>">Retirer</a>
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
		<button onclick="autre()">Voir les véhicules disponibles appartenant aux autres catégories</button>
		<button onclick="vehiculecategorie()">Voir les véhicules disponibles appartenant à la catégorie</button>
		<div id="resultatvehicule"></div>
		<div id="resultatautre"></div>
		<div id="resultatcategorie"></div>
<script src="_js/equipement.class.js"></script>
<script>

//update instannée et réciproque des deux inputs dates (debut et fin)
function modifyDate() {
	if (document.getElementById("loc_id").value==0) {
		let date_fin=document.getElementById("date_fin")
		date_fin.value=document.getElementById("date_debut").value
		let heure_fin=document.getElementById("heure_fin")
		heure_fin.value=document.getElementById("heure_debut").value
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

//function ajax pour afficher les véhicules disponibles entre deux dates en fonction de la catégorie et de l'agence de départ sélectionnée
function afficher() {
	var xmlhttp;
	//récupération de la date de début et de la date de fin
	let fin = date_fin.value + " " + heure_fin.value
	let debut = date_debut.value + " " + heure_debut.value
	//creation du paramètre
	var para="age_id="+loc_age_depart.value + "&" + "cat_id="+loc_categorie.value + "&" + "fin="+fin + "&" + "debut="+debut;
	xmlhttp= getXmlhttp();
	xmlhttp.open("GET","http://kevin/locacar/www/index.php?m=src&a=ajaxaffichervehiculedispo&" + para,true);
	xmlhttp.onreadystatechange=listevehiculedispo;
	xmlhttp.send();
	
	function listevehiculedispo() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("loc_vehicule").innerHTML += xmlhttp.responseText;
		}
	}
}

//function ajax pour afficher les véhicules disponibles entre deux dates en fonction de l'agence de départ sélectionnée
function autre() {
	var xmlhttp;
	//récupération de la date de début et de la date de fin
	let fin = date_fin.value + " " + heure_fin.value
	let debut = date_debut.value + " " + heure_debut.value
	//creation du paramètre
	var para="age_id="+loc_age_depart.value + "&" + "fin="+fin + "&" + "debut="+debut;
	xmlhttp= getXmlhttp();
	xmlhttp.open("GET","http://kevin/locacar/www/index.php?m=src&a=ajaxautrevehiculedispo&" + para,true);
	xmlhttp.onreadystatechange=autrevehiculedispo;
	xmlhttp.send();
	
	function autrevehiculedispo() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("resultatautre").innerHTML += xmlhttp.responseText;
		}
	}
}


//function ajax pour afficher les véhicules disponibles entre deux dates en fonction de la cactégorie sélectionnée
function vehiculecategorie() {
	var xmlhttp;
	//récupération de la date de début et de la date de fin
	let fin = date_fin.value + " " + heure_fin.value
	let debut = date_debut.value + " " + heure_debut.value
	//creation du paramètre
	var para="cat_id="+loc_categorie.value + "&" + "fin="+fin + "&" + "debut="+debut;
	xmlhttp= getXmlhttp();
	xmlhttp.open("GET","http://kevin/locacar/www/index.php?m=src&a=ajaxvehiculedispocat&" + para,true);
	xmlhttp.onreadystatechange=vehiculedispocat;
	xmlhttp.send();
	
	function vehiculedispocat() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("resultatcategorie").innerHTML += xmlhttp.responseText;
		}
	}
}

afficher();
</script>