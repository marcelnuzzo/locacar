<h3>Authentification</h3>
<?php if (isset($_GET["para"])) {
	echo "<div class='alert alert-primary' role='alert'>Erreur d'authentification</div>";
?>
	<div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav">
			<li><a href='<?=hlien("accueil","index")?>'>Accueil</a></li>
		</ul>
	</div>
<?php } ?>
<form method="post" action="<?php echo hlien("authentification","index")?>">			
	<div class="form-group row">
		<div class="col-md-2"><label for="cli_mail">Mail : </label></div>
		<div class="col-md-6"><input type="mail" id="cli_mail" autofocus name="cli_mail"></div>
	</div>						
	<div class="form-group row">
		<div class="col-md-2"><label for="cli_mdp">Mot de passe : </label></div>
		<div class="col-md-6"><input type="password" id="cli_mdp" name="cli_mdp"></div>
	</div>						
	<div class="form-group row">
		<input class="btn btn-success" type="submit" value="Enregistrer" name="btSubmit" >&nbsp;
		<input class="btn btn-danger" type="reset" value="Annuler" name="btReset" >
	</div>
</form>

