	<h2><?=$tar_id ? "Modification de $tar_id" : "Ajouter un nouveau tarif"?></h2>
<form method="post" action="<?=hlien("tarif","save")?>">
	<input type="hidden" name="tar_id" id="tar_id" value="<?=$id ?>" />
	</br>				
	<div class='form-group'>
		<label for='tar_thj'>Tarif horaire</label>
		<input id='tar_thj' name='tar_thj' type='number' size="50"  autofocus title="Saisissez le nouveau tarif" value='<?=mhe($tar_thj)?>' />
	</div>  
	<div class='form-group'>
		<label for='tar_pla'>Plage horaire</label>
		<?php if($tar_id==0) { ?>
		<select  id='tar_pla' name='tar_pla' >
		<?php } else { ?>
		<select disabled id='tar_pla' name='tar_pla' >
		<?php } ?>
			<?=Entity::HTMLselect("select pla_id id,concat(pla_hmin,' - ',pla_hmax) label from plage_horaire",$pla_id)?>
		</select>
	</div>
	<div class='form-group'>
		<label for='tar_categorie'>categorie</label>
		<?php if($tar_id==0) { ?>
		<select id='tar_categorie' name='tar_categorie' >	
		<?php } else { ?>
		<select disabled id='tar_categorie' name='tar_categorie' >
		<?php } ?>
			<?=Entity::HTMLselect("select cat_id id, cat_nom label from categorie",$cat_id)?>
		</select>
	</div>		
	<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
</form>  