	<?php
	if (isset($_SESSION["msgerreur"])) {
		echo $_SESSION["msgerreur"];
		unset($_SESSION["msgerreur"]);
	}
	?>
		<h2>Rechercher les véhicules disponibles</h2>
		<form method="post" action="<?=hlien("profilclient","test")?>" onsubmit="return go()">
			<input type="hidden" name="loc_id" id="loc_id" value="<?= $id ?>" />
			<div class='form-group'>
				<label for='date_debut'>Date de début :</label>
				<input id='date_debut' name='date_debut' type='date' value='<?=$date_debut?>' onchange='modifyDate()' required />
				<label for='heure_debut'>Heure de début :</label>
				<input id='heure_debut' name='heure_debut' type='time' value='<?=$heure_debut?>' onchange='modifyDate()' required />
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
			<div class='form-group'>
				<label for='veh_categorie'>Nom de la catégorie :</label>
				<select id='loc_categorie' name='loc_categorie' >
				<?=Entity::HTMLselect("select cat_id id, cat_nom label from categorie",$loc_categorie)?>
				</select>
			</div>
			<?php if ($id>0) { ?>
		<h3>Liste des options demandées :</h3>
		<?php foreach($resultOption as $row) {?>
			<p><?=$row["opt_id"]?> - <?=$row["opt_nom"]?> - 
			<a class="btn btn-danger" href="<?=hlien("location","desequiper","con_id",$row["con_id"],"loc_id",$id)?>">Supprimer</a>
			</p>
		<?php } ?>
		<?php } ?>
			<div class='form-group' id="divoption">
				<div id="espace_ajoutOption"></div>
				<button type="button" id="btAjouterOption" onclick="btAjoutOption()">Ajouter une option supplémentaire</button>
		</div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
		</form>
	<script src="_js/equipement.class.js"></script>
	<script>
	
	var loc_option=<?=$jsonoption?>;
	
	var cpt=1;
	function btAjoutOption() {
	new Equipement("a1",espace_ajoutOption,"Choix des options",cpt++);
}


		function modifyDate() {
			if (document.getElementById("loc_id").value==0) {
				let date_fin=document.getElementById("date_fin")
				date_fin.value=document.getElementById("date_debut").value
				let heure_fin=document.getElementById("heure_fin")
				heure_fin.value=document.getElementById("heure_debut").value
			}
		}
		
		
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
			</script>