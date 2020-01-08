<?php
$hash='$2y$10$FbXaNMjPihmA.Jjak2ANEecLg1lcAD4Yl6gUH2HAvbklbNzcGJ07m';
$mdp='mdp client 2';
$go=password_hash($mdp,PASSWORD_DEFAULT);
echo $go;
echo "<hr>";
echo "sortie : " . password_verify($mdp,  $go);

?>