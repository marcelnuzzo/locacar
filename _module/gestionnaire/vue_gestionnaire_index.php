        <h2>Gestionnaire</h2>
        <p><a class="btn btn-warning" href="<?=hlien("gestionnaire","edit","id",0)?>">Nouveau gestionnaire</a></p>
	<table class="table table-striped table-bordered table-hover">
		<tr>		
			<th><a href="<?=hlien("gestionnaire","index","tri","ges_id")?>">Identifiant</a></th>
			<th><a href="<?=hlien("gestionnaire","index","tri","ges_nom")?>">Nom</a></th>
			<th>Prenom</th>
			<th>Mail</th>
			<th>Mot de passe</th>
			<th>profil</th>
			<th>Nom de l'agence</th>
			<th>modifier</th>
			<th>supprimer</th>
		</tr>
		<?php
		foreach ( $result as $row) { 
			extract($row); ?>
		<tr>		
			<td><?=mhe($row['ges_id'])?></td>
			<td><?=mhe($row['ges_nom'])?></td>
			<td><?=mhe($row['ges_prenom'])?></td>
			<td><?=mhe($row['ges_mail'])?></td>
			<td><?=mhe($row['ges_mdp'])?></td>
			<td><?=mhe($row['ges_profil'])?></td>
			<td><?=mhe($row['age_nom'])?></td><td><a class="btn btn-info" href="<?=hlien("gestionnaire","edit","id",$row["ges_id"])?>">Modifier<span class="sr-only"><?=mhe($row['ges_nom'])?></span></a></td>
			<td><a class="btn btn-danger" href="<?=hlien("gestionnaire","del","id",$row["ges_id"])?>">Supprimer<span class="sr-only"><?=mhe($row['ges_nom'])?></span></a></td>
		</tr>
		<?php } ?>
	</table>