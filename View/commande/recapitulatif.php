<div class="half-content">
	<h2>
		Récapitulatif de votre commande
	</h2>

	<table>
		<thead>
			<th>
				Produit
			</th>
			<th>
				Quantité
			</th>
			<th>
				Prix unitaire
			</th>
			<th>
				Prix total
			</th>
		</thead>
		<?php

			$total_price = 0;

			foreach (json_decode($cart_content) as $product) {
				echo "<tr>";

				// Product name
				echo "<td>" . $product->libelle . " (" . $product->cp_libelle . ")</td>";

				// Quantity
				echo "<td>" . $product->quantite . "</td>";

				// Unit price
				echo "<td>" . $product->prix . " €</td>";

				// Total price
				echo "<td>" . ($product->prix * $product->quantite) . " €</td>";

				$total_price += ($product->prix * $product->quantite);
			}

		?>
		
	</table>
	<div class="form-item submit" style="margin-top: 5px;">
		<button onclick="send_command()">Commander (<?php echo $total_price; ?> €)</button>
	</div>
</div>