        <h2>Liste des options</h2>
		<ol>
		<?php
		foreach ($result as $row) {  
			echo "<li>" . $row['opt_nom'] . " - " . $row['opt_prix'] . "€";
		}
		?>
		</ol>