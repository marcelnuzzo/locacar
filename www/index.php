<?php

require "../_include/inc_config.php";
var_dump($_SESSION);
var_dump($_POST);
$controleur=(isset($_GET["m"]) ) ? $_GET["m"] : "_default";
$action=(isset($_GET["a"]) ) ? $_GET["a"] : "index";
$module = "Ctr_" . $controleur;
new $module($action);

?>
