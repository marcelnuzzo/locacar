        <h2>Gestion des locations</h2>
        <p><a class="btn btn-warning" href="<?=hlien("location","edit","id",0)?>">Ajouter une nouvelle location</a></p>
	<table class="table table-striped table-bordered table-hover">
		<tr>
			<th rowspan="2">Identifiant de l'agence</th>
			<th rowspan="2">Nom de l'agence</th>
			<th colspan="3">État de la demande</th>
			<th rowspan="2">Total</th>
		</tr>
		<tr>
			<td>Annulée</td>
			<td>Initialisée</td>
			<td>Validée</td>
		</tr>
		<?php
		foreach ($result as $row) { 
		?>
		<tr>
			<td><?=mhe($row['age_id'])?></td>
			<td><?=mhe($row['age_nom'])?></td>
			<?php
			foreach ($resultannule as $tab1)
			echo "<td>" . $tab1["nbannule"] . "</td>";
			?>
			<?php
			foreach ($resultinitialise as $tab2)
			echo "<td>" . $tab2["nbinitialise"] . "</td>";
			?>
			<?php
			foreach ($resultvalide as $tab3)
			echo "<td>" . $tab3["nbvalide"] . "</td>";
			?>
			<td>Total</td>
			<?php } ?>
		</tr>
	</table>