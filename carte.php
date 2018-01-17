<?php

	// Include header
	Include "header.php";

?>

<!-- LISTE DU PANIER -->
<nav class="sidenav">
	<h2>Panier</h2>
	<div id="panier">
		<?php
			
			// Si le panier existe
			if (isset($_COOKIE["panier"])) {
				var_dump($_COOKIE["panier"]);
			} else {
				echo "Le panier est vide";
			}
			
		
		?>
	</div>
		
</nav>

<!-- AFFICHAGE DE LA CARTE -->
<div class="wrapper-sidenav">
	<div class="content">

		<!-- NAV CAT PRODUIT -->
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
					// Display a rounded nav element
					echo "	<a href='carte.php?category=".$cat["libelle"]."'  style='text-decoration: none;'>
								<div class='roundcontainer'>
									<img src='img/product_category/" . $cat["image"] . "'></div>
									<p>".$cat["libelle"]."</p>
								</li>
							</a>";
				}
			?>
		</ul>

		<!-- TITRE -->
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

		<!-- LISTE PRODUIT -->
		<div class="card-grid">
			<?php

				// Display product
				foreach ($produits as $produit) {

					echo '
						<div class="card">
							<img src="img/product/'.$produit["CP_LIB"].'/'.$produit["image"].'"/>
							<div class="price">'.$produit["prix"].' €</div>
							<div class="desc">
								<h3>'.$produit["libelle"].'</h3>
								<p>
									'.$produit["description"].'
								</p><a onclick="ajout_panier(\''.$produit["id"].'\')">Ajouter au panier</a>
							</div>
						</div>
					';

				}
			
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
	function ajout_panier(product_id) {
		$.post( "Controller/PanierController.php", { 
													function: "ajout_panier", 
													product_id: product_id
												})
			.done(function( data ) {
				refresh_panier();
			});
	}

	function refresh_panier() {
		$.post( "Controller/PanierController.php", { function: "get_panier" })
			.done(function( data ) {
				var elem_panier = document.getElementById("panier");
				elem_panier.innerHTML = data;
			});
	}
</script>