		<h2>Rechercher les véhicules disponibles</h2>
		<div class='form-group'>
			<label for='date_debut'>Date de début :</label>
			<input id='date_debut' name='date_debut' type='date' value='<?=$date_debut?>' onchange='modifyDate()' required />
			<label for='heure_debut'>Heure de début :</label>
			<input id='heure_debut' name='heure_debut' type='time' onchange='appelAjax()' value='<?=$heure_debut?>' required />
		</div>
		<div class='form-group'>
			<label for='date_fin'>Date de fin :</label>
			<input id='date_fin' name='date_fin' type='date' value='<?=$date_fin?>' onchange='alertDate' required />
			<label for='heure_fin'>Heure de fin :</label>
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
		<div class='form-group'>
			<label for='loc_categorie'>Nom de la catégorie :</label>
			<select id='loc_categorie' name='loc_categorie' >
			<?=Entity::HTMLselect("select cat_id id, cat_nom label from categorie",$loc_categorie)?>
			</select>
		</div>
		<button onclick="afficher()">Afficher les véhicules disponibles</button>
		<div id="resultatvehicule"></div>
		<div id="resultatautre"></div>
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
	xmlhttp.open("GET","http://marcel/locacar/www/index.php?m=profilclient&a=ajaxaffichervehiculedispo&" + para,true);
	xmlhttp.onreadystatechange=listevehiculedispo;
	xmlhttp.send();
	
	function listevehiculedispo() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("resultatvehicule").innerHTML += xmlhttp.responseText;
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
	xmlhttp.open("GET","http://marcel/locacar/www/index.php?m=profilclient&a=ajaxautrevehiculedispo&" + para,true);
	xmlhttp.onreadystatechange=autrevehiculedispo;
	xmlhttp.send();
	
	function autrevehiculedispo() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("resultatautre").innerHTML += xmlhttp.responseText;
		}
	}
}

</script>