<h2><?=$pla_id ? "Modification de : $pla_id" : "Ajouter une nouvelle plage horaire"?></h2>
<form method="post" action="<?=hlien("plage_horaire","save")?>">
	<input id='pla_id' name="pla_id" id="pla_id" value="<?= $id ?>"/>                         
	</br>
	<div>
		<label for='pla_hmin'>Heure min</label>		
		<input id='pla_hmin' name='pla_hmin' type='number' min='0' value='<?=mhe($pla_hmin)?>' />	
	</div>
	</br>
	<div>
		<label for='pla_hmax'>Heure max</label>		
		<input id='pla_hmax' name='pla_hmax' type='number' value='<?=mhe($pla_hmin)?>' />	
	</div>
	</br>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
</form>              