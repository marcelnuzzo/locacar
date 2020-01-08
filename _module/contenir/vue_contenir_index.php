        <h2>contenir</h2>
        <p><a class="btn btn-warning" href="<?=hlien("contenir","edit","id",0)?>">Nouveau contenir</a></p>
	<table class="table table-striped table-bordered table-hover">
		<tr>
			<th><a href="<?=hlien("contenir","index","tri","con_id")?>">Identifiant de contenir</a></th>
			<th>Options du véhicule</th>
			<th><a href="<?=hlien("contenir","index","tri","con_location")?>">Numéro de la location</a></th>
			<th>modifier</th>
			<th>supprimer</th>
		</tr>
		<?php
		foreach ( $result as $row) { 
			extract($row); ?>
		<tr>
			
			<td><?=mhe($row['con_id'])?></td>
			<td><?=mhe($row['opt_nom'])?></td>
			<td><?=mhe($row['con_location'])?></td><td><a class="btn btn-info" href="<?=hlien("contenir","edit","id",$row["con_id"])?>">Modifier<span class="sr-only"><?=mhe($row['con_id'])?></span></a></td>
			<td><a class="btn btn-danger" href="<?=hlien("contenir","del","id",$row["con_id"])?>">Supprimer<span class="sr-only"><?=mhe($row['con_id'])?></span></a></td>
		</tr>
		<?php } ?>
	</table>