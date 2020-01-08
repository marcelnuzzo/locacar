<nav class="navbar  navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target="#myNavbar">
				<span class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">&nbsp;</a>
		</div>
    	<div class="collapse navbar-collapse" id="myNavbar">
			<?php if(!isset($_SESSION["profil"])=="anonyme") { ?>
				<ul class="nav navbar-nav">
					<li><a href='<?=hlien("accueil","index")?>'>Accueil</a></li>
					<li><a href='<?=hlien("profilclient","indexAge")?>'>Trouver une agence</a></li>
					<li><a href='<?=hlien("profilclient","indexCat")?>'>Les categories des véhicules</a></li>
					<li><a href='<?=hlien("profilclient","indexOpt")?>'>Les options des véhicules</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href='<?=hlien("authentification","index")?>'>Connexion</a></li>
					<li><a href='<?=hlien("profilclient","inscription")?>'>Inscription</a></li>
				</ul>
      		<?php } else if($_SESSION["profil"]=="admin") { ?>
      		<ul class="nav navbar-nav">
				<li><a href='<?=hlien("agence","index")?>'>Agence</a></li>
				<li><a href='<?=hlien("categorie","index")?>'>Categorie</a></li>
				<li><a href='<?=hlien("client","index")?>'>Client</a></li>
				<li><a href='<?=hlien("tarif","index")?>'>tarif</a></li>
				<li><a href='<?=hlien("departement","index")?>'>Departement</a></li>
				<li><a href='<?=hlien("gestionnaire","index")?>'>Gestionnaire</a></li>
				<li><a href='<?=hlien("location","index")?>'>Location</a></li>
				<li><a href='<?=hlien("options","index")?>'>Options</a></li>
				<li><a href='<?=hlien("plage_horaire","index")?>'>Plage_horaire</a></li>
				<li><a href='<?=hlien("vehicule","index")?>'>Vehicule</a></li>
				<li><a href='<?=hlien("contenir","index")?>'>Contenir</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?=hlien("authentification","deconnexion")?>">Déconnexion</a></li>
			</ul>
          	<?php } else if($_SESSION["profil"]=="src") { ?>
          		<ul class="nav navbar-nav">
					<li><a href='<?=hlien("src","client")?>'>Consulter les clients</a></li>
					<li><a href='<?=hlien("src","location")?>'>Consulter les locations</a></li>
					<li><a href='<?=hlien("src","index")?>'>Tableau de bord</a></li>
					<li><a href='<?=hlien("gestionnaire","index")?>'>Gestionnaire</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?=hlien("authentification","deconnexion")?>">Déconnexion</a></li>
				</ul>
			<?php } else if($_SESSION["profil"]=="gestion") { ?>
				<ul class="nav navbar-nav">
					<li><a href='<?=hlien("profilgestionnaire","indexVehDispo")?>'>Les véhicules disponibles de l'agence</a></li>
					<li><a href='<?=hlien("profilgestionnaire","indexLoc")?>'>Les locations de l'agence</a></li>
					<li><a href='<?=hlien("vehicule","index")?>'>Vehicule</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href='<?=hlien("authentification","deconnexion")?>'>Déconnexion</a></li>
				</ul>
			<?php } else if($_SESSION["profil"]=="client") {?>
				<ul class="nav navbar-nav">
					<li><a href='<?=hlien("accueil","index")?>'>Accueil</a></li>
					<li><a href='<?=hlien("client","index")?>'>Client</a></li>
					<li><a href='<?=hlien("location","index")?>'>Location</a></li>
					<li><a href='<?=hlien("profilclient","index")?>'>toto location</a></li>
					<li><a href='<?=hlien("profilclient","demande")?>'>Demande de location</a></li>
					<li><a href='<?=hlien("profilclient","dispovehicule")?>'>Les véhicules disponibles</a></li>
					<li><a href='<?=hlien("profilclient","indexCat")?>'>Les categories des véhicules</a></li>
					<li><a href='<?=hlien("profilclient","indexAge")?>'>Trouver une agence</a></li>
					<li><a href='<?=hlien("profilclient","indexOpt")?>'>Les options des véhicules</a></li>
					<li><a href='<?=hlien("profilclient","edit")?>'>Modifier mes informations </a></li>
					<li><a href='<?=hlien("profilclient","historique")?>'>Historique de mes locations </a></li>
					<li><a href='<?=hlien("profilclient","locencours")?>'>Locations en cours </a></li>
					<li><a href='<?=hlien("profilclient","locavenir")?>'>Locations à venir </a></li>
					<li><a href='<?=hlien("profilclient","toutesMesLoc")?>'>Toutes mes locations </a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href='<?=hlien("authentification","deconnexion")?>'>Déconnexion</a></li>
				</ul>			
			<?php } ?>
      		</ul>
		</div>
	</div>
</nav>

<script>
    tab=document.querySelectorAll(".nav > li > a");
    const module="<?=ucfirst($this->module)?>";
    tab.forEach(function(obj) {
        if (obj.innerHTML===module) {
            obj.parentElement.className="menusel";
            return true;
        }
    });
</script>