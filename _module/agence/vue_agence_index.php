        <h2>Gestion des agences</h2>
        <p><a class="btn btn-warning" href="<?=hlien("agence","edit","id",0)?>">Ajouter une nouvelle agence</a></p>
	<table class="table table-striped table-bordered table-hover">
		<tr>	
			<th><a href="<?=hlien("agence","index","tri","age_id")?>">Identifiant de l'agence</a></th>
			<th><a href="<?=hlien("agence","index","tri","age_nom")?>">Nom de l'agence</a></th>
			<th><a href="<?=hlien("agence","index","tri","age_adresse")?>">Adresse de l'agence</a></th>
			<th><a href="<?=hlien("agence","index","tri","age_departement")?>">Département</a></th>
			<th>modifier</th>
			<th>supprimer</th>
		</tr>
		<?php
		foreach ( $result as $row) { 
			extract($row); ?>
		<tr>
			<td><?=mhe($row['age_id'])?></td>
			<td><?=mhe($row['age_nom'])?></td>
			<td><?=mhe($row['age_adresse'])?></td>
			<td><?=mhe($row['dep_nom'])?></td>
			<td><a class="btn btn-info" href="<?=hlien("agence","edit","id",$row["age_id"])?>">Modifier <span class="sr-only"><?=mhe($row['age_nom'])?></span></td>
			<td><a class="btn btn-danger" onclick="alertConfirm()" href="<?=hlien("agence","del","id",$row["age_id"])?>">Supprimer <span class="sr-only"><?=mhe($row['age_nom'])?></span></td>
		</tr>
		<?php } ?>
	</table>