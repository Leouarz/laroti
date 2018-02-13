<!-- NAV CAT PRODUIT -->
<ul class="roundnav">
	<?php

		// Display category menu
		foreach ($product_categories as $product_category) {
			// IF current category then .active
			if ($product_category["active"]) {
				echo "<li class='active'>";
			} else {
				echo "<li>";
			}
			// Display a rounded nav element
			echo "	<a href='" . ROOT_PATH . "carte/filterOnCategory/".$product_category["libelle"]."'  style='text-decoration: none;'>
						<div class='roundcontainer'>
							<img src='" . ROOT_PATH . "Image/product_category/" . $product_category["image"] . "'></div>
							<p>".$product_category["libelle"]."</p>
						</li>
					</a>";
		}
	?>
</ul>

<!-- TITLE -->
<h1><?php echo $title; ?></h1>

<!-- LISTE PRODUIT -->
<div class="card-grid">
	<?php

		// Display product
		foreach ($products as $product) {

			echo '
				<div class="card">
					<img src="' . ROOT_PATH . 'Image/product/'.$product["CP_LIB"].'/'.$product["image"].'"/>
					<div class="price">'.$product["prix"].' €</div>
					<div class="desc">
						<h3>'.$product["libelle"].'</h3>
						<p>
							'.$product["description"].'
						</p><a onclick="ajout_panier(\''.$product["id"].'\')">Ajouter au panier</a>
					</div>
				</div>
			';

		}
	
	?>
</div>