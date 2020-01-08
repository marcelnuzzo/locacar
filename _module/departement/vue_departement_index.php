        <h2>Liste département</h2>
        <p><a class="btn btn-warning" href="<?=hlien("departement","edit","id",0)?>">Nouveau departement</a></p>
	<table class="table table-striped table-bordered table-hover">
		<tr>
			<th><a href="<?=hlien("departement","index","tri","dep_id")?>">Identifiant du département</a></th>
			<th><a href="<?=hlien("departement","index","tri","dep_code")?>">Code du département</a></th>
			<th><a href="<?=hlien("departement","index","tri","dep_nom")?>">Nom du département</a></th>
			<th>modifier</th>
			<th>supprimer</th>
		</tr>
		<?php
		foreach ( $result as $row) { 
			extract($row); ?>
		<tr>	
			<td><?=mhe($row['dep_id'])?></td>
			<td><?=mhe($row['dep_code'])?></td>
			<td><?=mhe($row['dep_nom'])?></td><td><a class="btn btn-info" href="<?=hlien("departement","edit","id",$row["dep_id"])?>">Modifier<span class="sr-only"><?=mhe($row['dep_nom'])?></span></a></td>
			<td><a class="btn btn-danger" href="<?=hlien("departement","del","id",$row["dep_id"])?>">Supprimer<span class="sr-only"><?=mhe($row['dep_nom'])?></span></a></td>
		</tr>
		<?php } ?>
	</table>