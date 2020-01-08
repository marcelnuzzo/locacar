			<h3>Les locations de l'agence</h3>
			<p><a class="btn btn-warning" href="<?=hlien("profilgestionnaire","editLoc","id",0)?>">Nouvelle location</a></p>
		<table class="table table-striped table-bordered table-hover">
			<tr>
				<th><a href="<?=hlien("profilgestionnaire","indexLoc","tri","loc_id")?>">loc_id</a></th>
				<th><a href="<?=hlien("profilgestionnaire","indexLoc","tri","loc_age_depart")?>">agence de départ</th>
				<th>date_début</th>
				<th>date_fin</th>
				<th>statut</th>
				<th>id_véhicule</th>
				<th>véhicule</th>
				<th>client</th>
				<th>Nom de l'option</th>
				<th>prix de l'option</th>
				<th>modifier</th>
				<th>supprimer</th>
			</tr>
			<?php foreach($result as $row) { ?>
				<tr>
					<td><?=mhe($row['loc_id'])?></td>
					<td><?=mhe($row['loc_age_depart'])?></td>
					<td><?=mhe($row['loc_date_debut'])?></td>
					<td><?=mhe($row['loc_date_fin'])?></td>
					<td><?=mhe($row['loc_statut'])?></td>
					<td><?=mhe($row['veh_id'])?></td>
					<td><?=mhe($row['veh_marque'])?></td>
					<td><?=mhe($row['cli_nom'])?></td>
					<td><?=mhe($row['opt_nom'])?></td>
					<td><?=mhe($row['opt_prix'])?></td>
					<td><a class="btn btn-info" href="<?=hlien("profilgestionnaire","editLoc","id",$row["loc_id"])?>">Modifier</a></td>
					<td><a class="btn btn-danger" href="<?=hlien("profilgestionnaire","del","id",$row["loc_id"])?>">Supprimer</a></td>
				</tr>
			<?php } ?>
		</table>
		