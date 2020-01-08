	<h2><?=$age_id ? "Modification $age_nom" : "Ajouter une nouvelle agence"?></h2>
	<form method="post" action="<?=hlien("agence","save")?>">
	<input type="hidden" name="age_id" id="age_id" value="<?= $id ?>" />
		<div class='form-group'>
			<label for='age_nom'>Nom de l'agence :</label>
			<input id='age_nom' name='age_nom' type='text' size='25' value='<?=mhe($age_nom)?>' autofocus title="Saisissez le nom de l'agence" />
		</div>
		<div class='form-group'>
			<label for='age_adresse'>Adresse postale de l'agence :</label>
			<input id='age_adresse' name='age_adresse' type='text' size='25' value='<?=mhe($age_adresse)?>'title="Saisissez l'adresse postale de l'agence" />
		</div>
		<div class='form-group'>
			<label for='age_departement'>Département :</label>
			<select id='age_departement' name='age_departement'  title='sélectionnez le département'>
			<?=Entity::HTMLselect("select dep_id id, dep_nom label from departement",$age_departement)?>
			</select>
		</div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>