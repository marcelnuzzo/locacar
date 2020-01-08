<!DOCTYPE html>
<html>
	<head>
		<?php require "../_include/inc_head.php" ?>
	</head>
	<body>
		<div class="container">
			<header>
				<?php require "../_include/inc_entete.php" ?>
			</header>
			<nav>
				<?php require "../_include/inc_menu.php"; ?>
			</nav>
			<div>				
				<?php require $this->vue; ?>				
			</div>
			<hr>
			<footer>
				<?php require "../_include/inc_pied.php"; ?>
			</footer>
		</div>
	</body>
</html>