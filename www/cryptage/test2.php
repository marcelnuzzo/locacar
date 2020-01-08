<?php
session_start();
$mdp_ref="login0";
$mdp="";
$mdpCrypte="";
	if (isset($_POST["btSubmit"])) {
		extract($_POST);
		$mdpCrypte=password_hash($mdp, PASSWORD_DEFAULT);
		var_dump($_POST);
	}
	else
	{
		
		//$mdpCrypte="";
		//$mdp="";
	}
if($mdp == $mdp_ref)
{
	if (password_verify($_POST["mdp"], $mdpCrypte)) {
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
		<p><?php echo "$mdp_ref" ;?></p>
		<p><?php echo "$mdp" ;?></p>
		<p><?php echo "$mdpCrypte" ;?></p>
		<p>$2y$10$FbXaNMjPihmA.Jjak2ANEecLg1lcAD4Yl6gUH2HAvbklbNzcGJ07m</p>
    </body>
</html>