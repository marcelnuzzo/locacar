        <h2>Gestion des locations intialisées</h2>
	<table class="table table-striped table-bordered table-hover">
		<tr>
			<th>Date de la demande</th>
			<th>Statut de la demande</th>
			<th>Tarif</th>
			<th>Consulter</th>
		</tr>
		<?php
		foreach ( $resultattente as $row) { 
			extract($row);
		?>
		<tr>
			<td><?=mhe($loc_date)?></td>
			<td><?=mhe($row['loc_statut'])?></td>
			<td>
			<?php
			$resultPrixOption=Location::montantOption($loc_id);
			$tab=$resultPrixOption->fetch(PDO::FETCH_ASSOC);
			$resultPrixLocation=Location::montantLocation($row['loc_id']);
			$ligne=$resultPrixLocation->fetch(PDO::FETCH_ASSOC);
			if ($ligne) { ?>
				Montant de la location (hors options) : <?=$ligne['prix_hors_option']?>€
				Montant de (ou des) option(s) : <?=$tab['prixoption']?>€
			<?php } ?>
			</td>
			<td><a class="btn btn-info" href="<?=hlien("src","ajoutlocation","id",$row["loc_id"])?>">Consulter <span class="sr-only">la demande n°<?=mhe($row['loc_id'])?></span></td></a></td></a></td>
		</tr>
		<?php } ?>
	</table>