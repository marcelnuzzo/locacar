<?php
/**
* Controleur générique pour CRUD
*/
class Ctr_controleur {
	//nom du module, également nom de la table pour le CRUD
	public $module;
	//nom de la méthode action à exécuter
    public $action;
	//Nom du fichier gabarit
    public $gabarit;
	//nom du fichier vue associé
    public $vue;
	//Menu secondaire associé au controleur
    public $menu;
	
	public function __construct($module, $action, $gabarit="inc_gabarit.php") {
        $this->module = $module;
        $this->action = $action;
        $this->menu = $module;
        $this->gabarit ="../_gabarit/$gabarit";
        $this->vue = "../_module/{$module}/vue_{$module}_{$action}.php";
    }
}