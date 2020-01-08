        <h2>Tarif</h2>
        <p><a class="btn btn-warning" href="<?=hlien("tarif","edit","id",0)?>">Nouveau tarif</a></p>
	<table class="table table-striped table-bordered table-hover">
		<tr>
			<th><a href="<?=hlien("tarif","index","tri","tar_id")?>">Identifiant du tarif</a></th>
			<th><a href="<?=hlien("tarif","index","tri","tar_thj")?>">Tarif horaire(en €)</a></th>
			<th><a href="<?=hlien("tarif","index","tri","tar_pla")?>">plage horaire</a></th>
			<th>Categorie</th>
			<th>modifier</th>
			<th>supprimer</th>
		</tr>
		<?php
		foreach ( $result as $row) { 
			extract($row); ?>
		<tr>	
			<td><?=mhe($row['tar_id'])?></td>
			<td><?=mhe($row['tar_thj'])?></td>
			<td><?=mhe("de" . " " . $row['pla_hmin'] . " " . "à" . " " . $row['pla_hmax'] . " " . "heures")?></td>
			<td><?=mhe($row['cat_nom'])?>
			</td><td><a class="btn btn-info" href="<?=hlien("tarif","edit","id",$row["tar_id"])?>">Modifier<span class="sr-only"><?=mhe($row['tar_id'])?></span></a></td>
			<td><a class="btn btn-danger" href="<?=hlien("tarif","del","id",$row["tar_id"])?>">Supprimer<span class="sr-only"><?=mhe($row['tar_id'])?></span></a></td>
		</tr>
		<?php } ?>
	</table>