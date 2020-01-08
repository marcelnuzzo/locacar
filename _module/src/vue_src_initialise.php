		<h2>Liste des demandes de locations initialisées</h2>
		<div class="panel-group" id="accordion">
		<ol>
		<?php
		foreach ($initialise as $row) { ?>
		<li>
			<button data-parent="#accordeon" class="btn" data-toggle="collapse" data-target="#collapse<?=$row['loc_id']?>" aria-expanded="false" aria-controls="collapse<?=$row['loc_id']?>">
				Demande de location n°<?=$row['loc_id']?> - Client n°<?=$row['cli_id']?>
			</button>
		</li>
			<div id="collapse<?=$row['loc_id']?>" class="collapse">
			<h3>Informations relatives à la demande de location n°<?=$row['loc_id']?> :<h3>
			<ul>
				<li>Date de début : <?=$row['loc_date_debut']?>
				<li>Date de fin : <?=$row['loc_date_fin']?>
				<li>Agence de départ : <?=$row['agedepart']?>
				<li>Agence d'arrivée : <?=$row['agefin']?>
				<li>Catégorie du véhicule : <?=$row['cat_nom']?>
			</ul>
			<div class='form-group'>
				<label for='loc_vehicule'>Sélectionnez le véhicule :</label>
				<select id='loc_vehicule' name='loc_vehicule' >
				<option value="0">Aucun véhicule</option>
				<?=Entity::HTMLselect("select veh_id id, veh_immatriculation label from vehicule",$loc_vehicule)?>
				</select>
			</div>
			<?php if ($id>0) { ?>
		<h3>Liste des options demandées :</h3>
		<?php foreach($resultOption as $row) {?>
			<p><?=$row["opt_id"]?> - <?=$row["opt_nom"]?> - 
			<a class="btn btn-danger" href="<?=hlien("location","desequiper","con_id",$row["con_id"],"loc_id",$id)?>">Supprimer</a>
			</p>

			<table class="lead">
				<thead>
					<tr>
						<th colspan="2">Informations relatives au client demandeur n°<?=$row['cli_id']?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>Identifiant du client</th>
						<td>n°<?=$row['cli_id']?></td>
					</tr>
					<tr>
						<th>Nom du client</th>
						<td><?=$row['cli_nom']?></td>
					</tr>
					<tr>
						<th>Prénom du client</th>
						<td><?=$row['cli_prenom']?></td>
					</tr>
					<tr>
						<th>Adresse mail du client</th>
						<td><a href="mailto:<?=$row['cli_mail']?>"><?=$row['cli_mail']?></a></td>
					</tr>
				</table>
				</tbody>
			</table>
</div>
		<?php } ?>
		</ol>
		</div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
		</form>
	<script src="_js/equipement.class.js"></script>
	<script>
	
	var loc_option=<?=$jsonoption?>;
	
	var cpt=1;
	function btAjoutOption() {
	new Equipement("a1",espace_ajoutOption,"Choix des options",cpt++);
}


		function modifyDate() {
			if (document.getElementById("loc_id").value==0) {
				let date_fin=document.getElementById("date_fin")
				date_fin.value=document.getElementById("date_debut").value
				let heure_fin=document.getElementById("heure_fin")
				heure_fin.value=document.getElementById("heure_debut").value
			}
		}
		
		
		function go() {
			let fin = document.getElementById("date_fin").value + " " + document.getElementById("heure_fin").value
			let debut = document.getElementById("date_debut").value + " " + document.getElementById("heure_debut").value
			if (fin<debut) {
				alert("Attention! La date de fin saisie est antérieure à la date de début.");
				return false;
			} else {
				return true;
			}
		}
			</script>