	<h2><?=$con_id ? "Modification de : $con_id" : "Ajouter une nouvelle ligne contenir"?></h2>
	</br>
	<form method="post" action="<?=hlien("contenir","save")?>">
	<input type="hidden" name="con_id" id="con_id" value="<?= $id ?>" />
		<div class='form-group'>
			<label for='con_options'>Options</label>
			<select id='opt_nom' name='opt_nom'  autofocus title="Modifiez l'option du véhicule" >
			<?=Entity::HTMLselect("select opt_id id, opt_nom label from options",$con_options)?>
			</select>
			</div>
			<div class='form-group'>
				<label for='con_location'>Location</label>
				<input id='con_location' name='con_location' type='number' size='50' value='<?=mhe($con_location)?>' />
			</div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>              