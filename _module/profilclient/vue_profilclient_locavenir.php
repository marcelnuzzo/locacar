			<h3>Mes locations à venir</h3>
		<table class="table table-striped table-bordered table-hover">
			<tr>
				<th><a href="<?=hlien("profilclient","locavenir","tri","loc_id")?>">loc_id</a></th>
				<th><a href="<?=hlien("profilclient","locavenir","tri","cli_nom")?>">client</a></th>
				<th><a href="<?=hlien("profilclient","locavenir","tri","age_nom")?>">statut</a></th>
				<th><a href="<?=hlien("profilclient","locavenir","tri","loc_date_debut")?>">date debut de location </a></th>
				<th><a href="<?=hlien("profilclient","locavenir","tri","loc_date_fin")?>">date debut de fin location </a></th>
				<th><a href="<?=hlien("profilclient","locavenir","tri","veh_nom")?>">Marque du vehicule</a></th>
				<th><a href="<?=hlien("profilclient","locavenir","tri","cat_nom")?>">Catégorie du vehicule</a></th>
				<th><a href="<?=hlien("profilclient","locavenir","tri","loc_date")?>">la date de la demande</a></th>

			</tr>
				
				<?php foreach($result as $row) { ?>
				         
				<tr>	
					<td><?=mhe($row['loc_id'])?></td>
					<td><?=mhe($row['cli_nom'])?></td>
					<td><?=mhe($row['loc_statut'])?></td>
					<td><?=mhe($row['loc_date_debut'])?></td>
					<td><?=mhe($row['loc_date_fin'])?></td>
					<td><?=mhe($row['veh_marque'])?></td>
					<td><?=mhe($row['cat_nom'])?></td>
					<td><?=mhe($row['loc_date'])?></td>

				</tr>
				<?php }  ?>
					<?php if(empty($row)) { ?>
					<h1 class="danger"> pas de locations à venir</h1>
					<?php }  ?>
		</table>
		