<?php
/**	inc_config.php est inclus sur toutes les pages du site **/
session_start();
//Pour afficher les jours et mois en français
setlocale(LC_TIME, 'fr-FR.UTF8','fra');
//Pour l'heure locale
date_default_timezone_set('Europe/Paris');

/** Les constantes **/
define("SITE_NOM","Locacar");
define("DB_SERVER","localhost");
define("DB_USER","root");
define("DB_PWD","");
define("DB_BDD","locacar");

require "../_include/inc_fonction.php";
require "../_include/_classe/Entity.class.php";
require "../_include/_classe/Ctr_controleur.class.php";

spl_autoload_register('monAutoLoad');

//connexion à la base de données
$link = new PDO("mysql:host=" . DB_SERVER .";port=3306;dbname=" . DB_BDD,DB_USER,DB_PWD);
$link->exec("SET CHARACTER SET UTF8");

Entity::setLink($link);

?>