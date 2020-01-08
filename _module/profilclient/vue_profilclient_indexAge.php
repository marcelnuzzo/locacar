			<h3>Les agences disponibles</h3>
		<table class="table table-striped table-bordered table-hover">
			<tr>
				<th><a href="<?=hlien("profilclient","indexAge","tri","dep_nom")?>">Nom du département</a></th>
				<th><a href="<?=hlien("profilclient","indexAge","tri","dep_code")?>">Code du département</a></th>
				<th><a href="<?=hlien("profilclient","indexAge","tri","age_nom")?>">Nom de l'agence</a></th>
			</tr>
			<?php foreach($result as $row) { ?>
				<tr>	
					<td><?=mhe($row['dep_nom'])?></td>
					<td><?=mhe($row['dep_code'])?></td>
					<td>
					<?php 
						$resultAge=Agence::listeAge($row['dep_id']);				
						foreach($resultAge as $ligne)
							echo "<li>" . $ligne["age_nom"] . "</li>";
					?>
					</td>
				</tr>
			<?php } ?>
		</table>
		