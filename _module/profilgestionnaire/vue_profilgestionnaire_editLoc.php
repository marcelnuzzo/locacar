        <h2><?=$loc_id ? "Modification $loc_id" : "Ajouter une nouvelle location"?></h2>
		<form method="post" action="<?=hlien("profilgestionnaire","save")?>">
		<input type="hidden" name="loc_id" id="loc_id" value="<?= $id ?>" />
						<div class='form-group'>
                            <label for='loc_age_depart'>Agence de départ</label>
                            <input id='loc_age_depart' name='loc_age_depart' autofocus type='text' size='50' value='<?=mhe($loc_age_depart)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='loc_date_debut'>Date_debut</label>
                            <input id='loc_date_debut' name='loc_date_debut' type='text' size='50' value='<?=mhe($loc_date_debut)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='loc_date_fin'>Date_fin</label>
                            <input id='loc_date_fin' name='loc_date_fin' type='text' size='50' value='<?=mhe($loc_date_fin)?>'  class='form-control' />
                        </div>                    
                        <div class='form-group'>
                            <label for='loc_statut'>Statut</label>
                            <input id='loc_statut' name='loc_statut' type='text' size='50' value='<?=mhe($loc_statut)?>'  class='form-control' />
                        </div>
						<div class='form-group'>
                            <label for='veh_id'>ID_veh</label>
                            <input id='veh_id' name='veh_id' type='text' size='50' value='<?=mhe($veh_id)?>'  class='form-control' />
                        </div>
						<div class='form-group'>
                            <label for='veh_marque'>Marque</label>
                            <input id='veh_marque' name='veh_marque' type='text' size='50' value='<?=mhe($veh_marque)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='cli_nom'>Client</label>
                            <input id='cli_nom' name='cli_nom' type='text' size='50' value='<?=mhe($cli_nom)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='opt_nom'>Option</label>
                            <input id='opt_nom' name='opt_nom' type='text' size='50' value='<?=mhe($opt_nom)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='opt_prix'>Prix_option</label>
                            <input id='opt_prix' name='opt_prix' type='text' size='50' value='<?=mhe($opt_prix)?>'  class='form-control' />
                        </div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>              