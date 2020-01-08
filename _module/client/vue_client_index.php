        <h2>Client</h2>
        <p><a class="btn btn-warning" href="<?=hlien("client","edit","id",0)?>">Nouveau client</a></p>
	<table class="table table-striped table-bordered table-hover">
		<tr>	
			<th><a href="<?=hlien("client","index","tri","cli_id")?>">Identifiant du client</a></th>
			<th><a href="<?=hlien("client","index","tri","cli_nom")?>">Nom du client</a></th>
			<th>Prenom</th>
			<th>Adresse</th>
			<th>Mail</th>
			<th>Mdp</th>
			<th>modifier</th>
			<th>supprimer</th>
		</tr>
		<?php
		foreach ( $result as $row) { 
			extract($row); ?>
		<tr>	
			<td><?=mhe($row['cli_id'])?></td>
			<td><?=mhe($row['cli_nom'])?></td>
			<td><?=mhe($row['cli_prenom'])?></td>
			<td><?=mhe($row['cli_adresse'])?></td>
			<td><?=mhe($row['cli_mail'])?></td>
			<td><?=mhe($row['cli_mdp'])?></td><td><a class="btn btn-info" href="<?=hlien("client","edit","id",$row["cli_id"])?>">Modifier<span class="sr-only"><?=mhe($row['cli_nom'])?></span></a></td>
			<td><a class="btn btn-danger" href="<?=hlien("client","del","id",$row["cli_id"])?>">Supprimer<span class="sr-only"><?=mhe($row['cli_nom'])?></span></a></td>
		</tr>
		<?php } ?>
	</table>