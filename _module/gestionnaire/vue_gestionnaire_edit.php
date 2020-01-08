	<h2><?=$ges_id ? "Modification du gestionnaire $ges_id" : "Ajouter un nouveau gestionnaire"?></h2>
	<form method="post" action="<?=hlien("gestionnaire","save")?>">
	<input type="hidden" name="ges_id" id="ges_id" value="<?= $id ?>" />
		<div class='form-group'>
			<label for='ges_nom'>Nom</label>
			<input id='ges_nom' name='ges_nom' type='text' size='20' autofocus value='<?=mhe($ges_nom)?>' /><!-- class='form-control' />
		-->
		</div>
		<div class='form-group'>
			<label for='ges_prenom'>Prenom</label>
			<input id='ges_prenom' name='ges_prenom' type='text' size='20' value='<?=mhe($ges_prenom)?>'  /><!--class='form-control' />-->
		</div>
		<div class='form-group'>
			<label for='ges_mail'>Mail</label>
			<input id='ges_mail' name='ges_mail' type='mail' size='
			50' value='<?=mhe($ges_mail)?>' /> <!--class='form-control' />-->
		</div>
		<div class='form-group'>		
			
				<label for="ges_mdp">Mot de passe: </label>
				<input id="ges_mdp" name="ges_mdp" type="password" class='form-control' >
			
		</div>
		<div class='form-group'>
			<label for="ges_profil">profil</label>
			 <select id='ges_profil' name='ges_profil' onchange="myFunction()">	
				<option value="admin" <?=($ges_profil=="admin") ? "selected" : ""?> >admin</option>
				<option value="src"  <?=($ges_profil=="src") ? "selected" : ""?> >Src</option>
				<option value="gestion"  <?=($ges_profil=="gestion") ? "selected" : ""?> >Gestion</option>
			</select>
		</div>
		<div class='form-group' id="divagence">
			<label for='ges_agence'>Agence</label>
			<select id='ges_agence' name='ges_agence' >
			<?=Entity::HTMLselect("select age_id id, age_nom label from agence",$ges_agence)?>
			</select>
		</div>
			<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
		&nbsp;&nbsp;<input class="btn btn-warning" type="button" value="Annuler" onclick="window.history.back()" />
	</form> 
	
	<script>
	
	function myFunction() {
		if(ges_profil.value=="admin" || ges_profil.value=="src" )  
			divagence.style.display = "none";
		else
			divagence.style.display = "block";  
	}
	myFunction();
	</script>
	