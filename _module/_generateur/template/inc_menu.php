<nav class="navbar  navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">&nbsp;</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="/">Accueil</a></li>
        [menu]
	  </ul>
      <ul class="nav navbar-nav navbar-right">
		<li><a href="<?=hlien("authentification","deconnexion")?>">Déconnexion</a></li>
		<li><a href='<?=hlien("authentification","connexion")?>'>Connexion</a></li>
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