			<h3>Les véhicules disponibles de l'agence</h3>
		<table class="table table-striped table-bordered table-hover">
			<tr>
				<th><a href="<?=hlien("profilgestionnaire","indexVehDispo","tri","veh_id")?>">veh_id</a></th>
				<th>Marque</th>
				<th><a href="<?=hlien("profilgestionnaire","indexVehDispo","tri","veh_immatriculation")?>">Immatriculation</a></th>
				<th>Catégorie</th>
				<th>date de réservation (début)</th>
				<th>date de réservation (fin)</th>
				<th>Statut</th>
			</tr>
			<?php foreach($result as $row) { ?>
				<tr>
					<td><?=mhe($row['veh_id'])?></td>
					<td><?=mhe($row['veh_marque'])?></td>
					<td><?=mhe($row['veh_immatriculation'])?></td>
					<td><?=mhe($row['cat_nom'])?></td>
					<td><?=mhe($row['loc_date_debut'])?></td>
					<td><?=mhe($row['loc_date_fin'])?></td>
					<td><?=mhe($row['loc_statut'])?></td>
				</tr>
			<?php } ?>
		</table>
		