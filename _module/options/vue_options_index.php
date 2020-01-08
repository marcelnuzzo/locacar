        <h2>options</h2>
        <p><a class="btn btn-warning" href="<?=hlien("options","edit","id",0)?>">Nouveau options</a></p>
	<table class="table table-striped table-bordered table-hover">
		<tr>
			<th><a href="<?=hlien("options","index","tri","opt_id")?>">Identifiant de l'option</a></th>
			<th>Nom</th>
			<th>Prix</th>
			<th>modifier</th>
			<th>supprimer</th>
		</tr>
		<?php
		foreach ( $result as $row) { 
			extract($row); ?>
		<tr>		
			<td><?=mhe($row['opt_id'])?></td>
			<td><?=mhe($row['opt_nom'])?></td>
			<td><?=mhe($row['opt_prix'])?></td><td><a class="btn btn-info" href="<?=hlien("options","edit","id",$row["opt_id"])?>">Modifier<span class="sr-only"><?=mhe($row['opt_nom'])?></span></a></td>
			<td><a class="btn btn-danger" href="<?=hlien("options","del","id",$row["opt_id"])?>">Supprimer<span class="sr-only"><?=mhe($row['opt_nom'])?></span></a></td>
		</tr>
		<?php } ?>
	</table>