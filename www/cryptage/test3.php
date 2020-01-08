<?php

$mdp_ref="login0";
$mdp="";
$mdpCrypte="";
	if (isset($_POST["btSubmit"])) {
		extract($_POST);
		$_SESSION["mdp"]=$mdp;
		$mdpCrypte=password_hash($mdp, PASSWORD_DEFAULT);
		var_dump($_POST);
	}
	else
	{
		$_SESSION["mdp"]="";
		//$mdpCrypte="";
		//$mdp="";
		//$mdpCrypte=password_hash($mdp, PASSWORD_DEFAULT);
	}
if($mdp == $mdp_ref)
{
	if (password_verify($_SESSION["mdp"], $mdpCrypte)) {
			echo 'Le mot de passe est valide !';
		} else {
			echo 'Le mot de passe est invalide.';
		}
}
else
	echo "no match";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>test password_h</title>
    </head>	
	<style>
		body {
			font-face:Arial;
			font-size:20px;
		}
		
		form {
			border: 2px solid #333;
			background-color:#ADE;
		}
	</style>	
    <body>
		<form method="post"> 
			<p>
				<label for="mdp">mdp : </label>
				<input type="mdp" id="mdp" name="mdp" >
			</p>			
			<p><input type="submit" value="Envoyer" name="btSubmit"  /></p>
		</form>	
		<p><?php echo "$mdp" ;?></p>
		<p><?php echo "$mdpCrypte" ;?></p>
    </body>
</html>