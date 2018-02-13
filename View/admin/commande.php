<h1>Liste des commandes</h1>

<div class="box-container">
	<?php

		foreach ($command_data as $command) {
			echo '<div class="box">';

			// Command title
			echo "<h2>" 
						.$command["prenom"].' '
						.$command["nom"].' <small>('
						.$command["adresse"].' '
						.$command["cp"].' '
						.$command["ville"].')</small>'.
				"</h2>";

			// Command date
			echo '<div class="date">' . $command["date_command"] . '</div>';

			// Product table
			echo '<table>
					<thead>
						<th>Libelle</th>
						<th>Quantité</th>
					</thead>
					<tbody>';
			foreach ($command["products"] as $product) {
				echo "<tr>";
				echo 	"<td>".$product["libelle"]." (".$product["categorie_lib"].")</td>";
				echo 	"<td>".$product["quantite"]."</td>";
				echo "</tr>";
			}
			echo '</tbody></table>';

			echo '	<div class="form-item submit" style="margin-top: 5px;">
						<button onclick="return false;">Commande terminée</button>
					</div>';

			echo '</div>';
		}

	?>
</div>