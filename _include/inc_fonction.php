<?php

//fabrique un lien en passant les parametres un par un
function hlien() {
	$args = func_get_args();
	$nb=count($args)/2;
	if (!is_int($nb)) {
		echo "ERREUR NOMBRE D'ARGUMENTS !!";
		exit;
	}
	$m=$args[0];
	$a=$args[1];
	
	if (!isset($args[2]))
        return "index.php?m=$m&a=$a";
    else {		
		$para=array();
		for( $i=1;$i<$nb;$i++)
			$para[]=$args[2*$i] . "=" . $args[2*$i+1];
		$s=implode("&",$para);
        return "index.php?m=$m&a=$a&$s";
	}
}

//Autoload
function monAutoLoad($classname) {
	if ("Ctr_" == substr($classname, 0, 4)) {
        $rep = str_replace("Ctr_", "", $classname);
        require_once "../_module/$rep/" . $classname . ".class.php";
    } else {
        require_once "../_classe/" . $classname . ".class.php";
    }	
}

/*
Affiche un tableau PHP à 2 dimensions sous la forme d'une table HTML
*/
function afficheTableHTML($data) {
	$fin=false;
	echo "<table>";
	foreach($data as $cleLigne => $ligne) {
		//affiche des entete de colonnes
		if (!$fin) {
			echo "<tr>";
			echo "<th></th>";
			foreach($ligne as $cle=>$valeur) {
				echo "<th>$cle</th>";
			}
			echo "</tr>";	
			$fin=true;
		}
		
		//affichage du tableau
		echo "<tr>";
		echo "<th>$cleLigne</th>";
		foreach($ligne as $cle=>$valeur) {
			echo "<td>$valeur</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}


function isAuth() {
	if (!isset($_SESSION["id"]))
		header("location:index.php");
}

function mres($s) {
	return mysqli_real_escape_string(Entity::$link,$s);
}

/**
Traitement des chaines avant affichage dans une pase HTML.
*/
function mhe($x) {
    return htmlentities($x, ENT_QUOTES, "utf-8");
}


?>