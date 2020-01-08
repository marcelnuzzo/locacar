        <h2>vehicule</h2>
        <p><a class="btn btn-warning" href="<?=hlien("vehicule","edit","id",0)?>">Nouveau vehicule</a></p>
	<table class="table table-striped table-bordered table-hover">
		<tr>
			<th><a href="<?=hlien("vehicule","index","tri","veh_id")?>">Identifiant du véhicule</a></th>
			<th>Marque</th>
			<th>Immatriculation</th>
			<th><a href="<?=hlien("vehicule","index","tri","veh_agence")?>">Nom de l'agence</a></th>
			<th>Categorie</th>
			<th>modifier</th>
			<th>supprimer</th>
		</tr>
		<?php
		foreach ( $result as $row) { 
			extract($row); ?>
		<tr>
			
			<td><?=mhe($row['veh_id'])?></td>
			<td><?=mhe($row['veh_marque'])?></td>
			<td><?=mhe($row['veh_immatriculation'])?></td>
			<td><?=mhe($row['age_nom'])?></td>
			<td><?=mhe($row['cat_nom'])?></td><td><a class="btn btn-info" href="<?=hlien("vehicule","edit","id",$row["veh_id"])?>">Modifier<span class="sr-only"><?=mhe($row['veh_marque'])?></span></a></td>
			<td><a class="btn btn-danger" href="<?=hlien("vehicule","del","id",$row["veh_id"])?>">Supprimer<span class="sr-only"><?=mhe($row['veh_marque'])?></span></a></td>
		</tr>
		<?php } ?>
	</table>