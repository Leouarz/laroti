<ul class="roundnav">
	<?php
		// GET each product categories
		$catProduit = $pdo->query("SELECT * FROM categorie_produit");

		// Display category menu
		foreach ($catProduit as $cat) {
			// IF current category then .active
			if (isset($_GET["category"]) && $_GET["category"] == $cat["libelle"]) {
				echo "<li class='active'>";
			} else {
				echo "<li>";
			}
			echo "	<a href='carte.php?category=".$cat["libelle"]."'  style='text-decoration: none;'>
						<div class='roundcontainer'>
							<img src='img/product_category/" . $cat["image"] . "'></div>
							<p>".$cat["libelle"]."</p>
						</li>
					</a>";
		}
	?>
</ul>

<div class="content">
	<?php
			
		// IF current category then .active
		if (isset($_GET["category"])) {
			echo "<h1 class='styled-title'>".$_GET["category"]."</h1>";
	
		// GET each product from category
		$produits = $pdo->query("
							SELECT 	p.* , cp.libelle as CP_LIB
							FROM 	produit p, categorie_produit cp
							WHERE 	cp.libelle = '".$_GET["category"]."'
							AND 	cp.id = p.categorie
						");
		} else {
			echo "<h1 class='styled-title'>Liste des produits</h1>";
	
		// GET each product
		$produits = $pdo->query("
							SELECT 		p.*, cp.libelle as CP_LIB
							FROM 		produit p, categorie_produit cp
							WHERE 		cp.id = p.categorie
							ORDER BY 	categorie
						");
		}
			
	?>

	<?php


		// Display category menu
		foreach ($produits as $produit) {

			echo '
				<div class="card">
					<img src="img/product/'.$produit["CP_LIB"].'/'.$produit["image"].'"/>
					<div class="price">'.$produit["prix"].' €</div>
					<div class="desc">
						<h3>'.$produit["libelle"].'</h3>
						<p>
							'.$produit["description"].'
						</p><a href="#">Ajouter au panier</a>
					</div>
				</div>
			';

		}
	

		fu
	?>

</div>
