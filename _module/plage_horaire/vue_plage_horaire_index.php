        <h2>plage_horaire</h2>
        <p><a class="btn btn-warning" href="<?=hlien("plage_horaire","edit","id",0)?>">Nouveau plage_horaire</a></p>
	<table class="table table-striped table-bordered table-hover">
		<tr>
			<th><a href="<?=hlien("plage_horaire","index","tri","pla_id")?>">Identifiant de la plage horaire</a></th>
			<th>Heure min</th>
			<th>Heure max</th>
			<th>modifier</th>
			<th>supprimer</th>
		</tr>
		<?php
		foreach ( $result as $row) { 
			extract($row); ?>
		<tr>
			
			<td><?=mhe($row['pla_id'])?></td>
			<td><?=mhe($row['pla_hmin'])?></td>
			<td><?=mhe($row['pla_hmax'])?></td>
			<td><a class="btn btn-info" href="<?=hlien("plage_horaire","edit","id",$row["pla_id"])?>">Modifier<span class="sr-only"><?=mhe($row['pla_id'])?></span></a></td>
			<td><a class="btn btn-danger" href="<?=hlien("plage_horaire","del","id",$row["pla_id"])?>">Supprimer<span class="sr-only" ><?=mhe($row['pla_id'])?></span></a></td>
			
		</tr>
		<?php } ?>
	</table>