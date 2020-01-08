	<h2><?=$cat_id ? "Modification de la catégorie" : "Ajouter une nouvelle catégorie"?></h2>
		</br>
	<form method="post" enctype="multipart/form-data" action="<?=hlien("categorie","save")?>">
	<input type="hidden" name="cat_id" id="cat_id" value="<?= $id ?>" />
		 <div class='form-group'>
			<label for='cat_nom'>Catégorie</label>
			<input id='cat_nom' name='cat_nom' type='text' size='15' autofocus title="categorie du véhicule" value='<?=mhe($cat_nom)?>' />
		</div>
		<div>
			Envoyez l'image au format jpg : <input type="file" name="monfichier" id="monfichier" / >
		</div>
		</br>
	<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>
