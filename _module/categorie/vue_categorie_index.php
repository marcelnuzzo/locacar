        <h2>Gestion des catégories</h2>
        <p><a class="btn btn-warning" href="<?=hlien("categorie","edit","id",0)?>">Ajouter une nouvelle catégorie</a></p>
	<table class="table table-striped table-bordered table-hover">
		<tr>
			<th><a href="<?=hlien("categorie","index","tri","age_id")?>">Identifiant de la catégorie</a></th>
			<th>Nom de la catégorie</th>
			<th>modifier</th>
			<th>supprimer</th>
		</tr>
		<?php
		foreach ( $result as $row) { 
			extract($row); ?>
		<tr>		
			<td><?=mhe($row['cat_id'])?></td>
			<td>
				<img src="_images/categorie_<?=$row['cat_id']?>.jpg"  width="100" alt="image d'une "><?=$cat_nom?>
			</td>
			<td><a  class="btn btn-info" href="<?=hlien("categorie","edit","id",$row["cat_id"])?>">Modifier <span class="sr-only"><?=mhe($row['cat_nom'])?></span></a></td>
			<td><a onclick="return confirm('êtes-vous sûr de vouloir supprimer catégorie <?=mhe($row['cat_nom'])?>?')" class="btn btn-danger" href="<?=hlien("categorie","del","id",$row["cat_id"])?>">Supprimer <span class="sr-only"><?=mhe($row['cat_nom'])?></span></a></td>
		</tr>
		<?php } ?>
	</table>