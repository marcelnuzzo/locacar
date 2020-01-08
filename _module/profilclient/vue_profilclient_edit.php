<h2>Inscription</h2>
<form method="post" name="form" onSubmit="return confirmer()" action="<?=hlien("profilclient","save")?>">

<input type="hidden" name="cli_id" id="cli_id" value="<?= $id ?>" />
	<div class='form-group'>
		<label for='cli_nom'>Nom :</label>
		<input id='cli_nom' name='cli_nom' type='text' size='25'  autofocus title="Saisissez le nom du client" value='<?=mhe($cli_nom)?>'  />
	</div>
	<div class='form-group'>
		<label for='cli_prenom'>Prenom :</label>
		<input id='cli_prenom' name='cli_prenom' type='text' size='25' value='<?=mhe($cli_prenom)?>' />
	</div>
	<div class='form-group'>
		<label for='cli_adresse'>Adresse :</label>
		<input id='cli_adresse' name='cli_adresse' type='text' size='50' value='<?=mhe($cli_adresse)?>'/>
	</div>
	<div class='form-group'>
		<label for='cli_mail'>Mail :</label>
		<input id='cli_mail' name='cli_mail' type='mail' size='50' value='<?=mhe($cli_mail)?>' />
	</div>
	
	<div>
		<label for='cli_mdp'>Entrez votre mot de passe :</label>
		<input id='cli_mdp' type="text" name="pass" value=''>
	</div>
	<div>
		<label for='cli_mdp2'>Confirmez le mot de passe :</label>
		<input id='cli_mdp2' type="password" name="pass2" value=''>
	</div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
</form>  
<script>
	function confirmer() {
		if(cli_mdp.value==cli_mdp2.value)
			return true;
		else
			return false;
	}
</script>                         