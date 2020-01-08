<h2><?=$veh_id ? "Modification $veh_id" : "Ajouter un nouveau véhicule"?></h2>
<form method="post" action="<?=hlien("vehicule","save")?>">
	</br>
	<input type="hidden" name="veh_id" id="veh_id" value="<?= $id ?>" />
	<div class='form-group'>
		<label for='veh_marque'>Marque</label>
		<input id='veh_marque' name='veh_marque' type='text' size='50' autofocus value='<?=mhe($veh_marque)?>' />
	</div>
	<div class='form-group'>
		<label for='veh_immatriculation'>Immatriculation</label>
		<input id='veh_immatriculation' name='veh_immatriculation' type='text' size='25' value='<?=mhe($veh_immatriculation)?>'  />
	</div>
	<div class='form-group'>
		<label for='veh_agence'>Agence</label>
		<select id='veh_agence' name='veh_agence' >
		<?=Entity::HTMLselect("select age_id id, age_nom label from agence",$veh_agence)?>
		</select>

	</div>
	<div class='form-group'>
		<label for='veh_categorie'>Categorie</label>
		<select id='veh_categorie' name='veh_categorie' >
		<?=Entity::HTMLselect("select cat_id id, cat_nom label from categorie",$veh_categorie)?>
		</select>
	</div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
</form>              