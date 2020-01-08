    <h2><?=$dep_id ? "Modification de $dep_nom" : "Ajouter une nouvelle agence"?></h2>  
	</br>	
	<form method="post" action="<?=hlien("departement","save")?>">
		<input type="hidden" name="dep_id" id="dep_id" value="<?= $id ?>" />
			<div class='form-group'>
				<label for='dep_code'>Code</label>
				<input id='dep_code' name='dep_code' type='text' size='5' value='<?=mhe($dep_code)?>' />
			</div>
			<div class='form-group'>
				<label for='dep_nom'>Nom</label>
				<input id='dep_nom' name='dep_nom' type='text' size='25' value='<?=mhe($dep_nom)?>' />
			</div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>              