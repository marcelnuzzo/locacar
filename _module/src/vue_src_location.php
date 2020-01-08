        <h2>Gestion des locations</h2>
        <p><a class="btn btn-warning" href="<?=hlien("src","ajoutlocation","id",0)?>">Ajouter une nouvelle location</a></p>
	<table class="table table-striped table-bordered table-hover">
		<tr>
			
			<th>Identifiant de la location</th>
			<th>Date de début</th>
			<th>Date de fin</th>
			<th>Agence de départ</th>
			<th>Agence d'arrivée</th>
			<th>État de la demande</th>
			<th>Nom du client</th>
			<th>Nom de l'agent</th>
			<th>Nom de la catégorie</th>
			<th>Nom du véhicule</th>
			<th>Liste des options</th>
			<th>Date de la demande</th>
			<th>Tarif</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
		<?php
		foreach ( $result as $row) { 
			extract($row);
			$loc_date_debut = utf8_encode(strftime("%A %d %B %Y %H:%M",strtotime($loc_date_debut)));
			$loc_date_fin = utf8_encode(strftime("%A %d %B %Y %H:%M",strtotime($loc_date_fin)));
			$loc_date = utf8_encode(strftime("%A %d %B %Y %H:%M",strtotime($loc_date)));
			?>
		<tr>
			
			<td><?=mhe($row['loc_id'])?></td>
			<td><?=mhe($loc_date_debut)?></td>
			<td><?=mhe($loc_date_fin)?></td>
			<td><?=mhe($row['agedepart'])?></td>
			<td><?=mhe($row['agefin'])?></td>
			<td><?=mhe($row['loc_statut'])?></td>
			<td><?=mhe($row['cli_nom'])?></td>
			<td><?=mhe($row['ges_nom'])?></td>
			<td><?=mhe($row['cat_nom'])?></td>
			<td><?=mhe($row['veh_immatriculation'])?></td>
			<td>
				<?php 
				$resultOption=Location::listeOption($row['loc_id']);
				?>
				<ul>
					<?php 
						foreach($resultOption as $ligne)
							echo "<li>" . $ligne["opt_id"] . " - " . $ligne["opt_nom"] . "</li>";
					?>
				</ul>
			</td>
			<td><?=mhe($loc_date)?></td>
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
			<td><a class="btn btn-info" href="<?=hlien("src","ajoutlocation","id",$row["loc_id"])?>">Modifier <span class="sr-only">la demande n°<?=mhe($row['loc_id'])?></span></td></a></td></a></td>
			<td><a onclick="return confirm('êtes-vous sûr de vouloir supprimer location n°<?=mhe($row['loc_id'])?>?')" class="btn btn-danger" href="<?=hlien("src","del","id",$row["loc_id"])?>">Supprimer <span class="sr-only">la demande n°<?=mhe($row['loc_id'])?></span></a></td>
		</tr>
		<?php } ?>
	</table>