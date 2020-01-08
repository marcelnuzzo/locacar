    <h2><?=$opt_id ? "Modification $opt_nom" : "Ajouter une nouvelle option"?></h2>
		<form method="post" action="<?=hlien("options","save")?>">
		<input type="hidden" name="opt_id" id="opt_id" value="<?= $id ?>" />
                        <div class='form-group'>
                            <label for='opt_nom'>Nom</label>
                            <input id='opt_nom' name='opt_nom' type='text' size='15' value='<?=mhe($opt_nom)?>' />
                        </div>
                        <div class='form-group'>
                            <label for='opt_prix'>Prix en €</label>
                            <input id='opt_prix' name='opt_prix' type='number' size='15' value='<?=mhe($opt_prix)?>' />
                        </div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>              