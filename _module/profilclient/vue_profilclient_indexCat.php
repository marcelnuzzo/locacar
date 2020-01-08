        <h2>Nos catégories de véhicules</h2>
		<ol>
		<?php
		foreach ($result as $row) { ?>
			<li>
				<div>
				<button class="btn" data-toggle="collapse" data-target="#collapse<?=$row['cat_id']?>" 
					aria-expanded="false" aria-controls="collapse<?=$row['cat_id']?>">
					<img src="_images/categorie_<?=$row['cat_id']?>.jpg" width="100" alt="Véhicule <?=$row['cat_nom']?>">
				</button>
				</div>
				<div id="collapse<?=$row['cat_id']?>" class="collapse">
					<ul>
					<?php
						$resultvehicule=Vehicule::listeCategorieVehicule($row['cat_id']);
						foreach($resultvehicule as $ligne)
							echo "<li>" . "Véhicule n°" . $ligne["veh_id"] . " - " . $ligne["veh_marque"] . "</li>";
					?>
					</ul>
				</div>
			</li>
		<?php } ?>
		</ol>