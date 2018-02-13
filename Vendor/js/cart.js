/**
* 	Initialize cart list
*/
$(document).ready(function() {
    refresh_panier();
});

/**
* 	Display cart
*/
function OpenCart() 
{
	var elem_panier = document.getElementById("cart");
	elem_panier.style.display = "block";
}

/**
* 	Hide cart
*/
function CloseCart() 
{
	var elem_panier = document.getElementById("cart");
	elem_panier.style.display = "none";
}

/**
* 	Add something to the cart
*/
function ajout_panier(product_id) {
	// AJAX Query for add to cart
	$.post(root_path + "panier/ajout_panier/" + product_id)
	.done(function( data ) {
		refresh_panier();
		display_message("primary", "<strong>Succes !</strong> Votre produit à bien été ajouté au panier.");
	});
}

/**
* 	Refresh the cart list
*/
function refresh_panier() {
	// AJAX Query for the cart list
	$.post(root_path + "panier/get_panier/")
	.done(function( data ) {
		// Initialize used vars
		var elem_panier = document.getElementById("cart-list");
		var html_cart_list = "";
		var total_price = 0;
		// Construct HTML output
		$.each(JSON.parse(data), function (id, product_data) {
			// Add QUANTITY
			html_cart_list += "<li class='item'><span class='quantity'>" + product_data.quantite + "x </span>";
			// Add PRODUCT_SPEC
			html_cart_list += product_data.libelle + " (" + product_data.cp_libelle + ")";
			// Add delete btn
			html_cart_list += "<i class='fa fa-times' onclick='drop_panier(" + product_data.id + ")'></i>";
			// Add PRICE
			var price = product_data.quantite * product_data.prix;
			total_price += price;
			html_cart_list += "<div class='price'>" + price + " €</div></li>"

		});

		if (html_cart_list == "") {
			elem_panier.innerHTML = "Le panier est vide, veuillez faire une commande.";
		} else {
			html_cart_list += "<li class='total'>TOTAL : " + total_price + "€</li>";
			html_cart_list += "<li class='submit'><a href=root_path + 'commande/recapitulatif/'><button>Commander</button></a></li>";
			elem_panier.innerHTML = html_cart_list;
		}
	});
}

/**
* 	Drop something from the cart
*/
function drop_panier(product_id) {
	// AJAX Query for add to cart
	$.post(root_path + "panier/drop_panier/" + product_id)
	.done(function( data ) {
		refresh_panier();
	});
}

/**
* 	Drop something from the cart
*/
function drop_all_panier() {
	// AJAX Query for add to cart
	$.post(root_path + "panier/drop_all_panier/")
	.done(function( data ) {
		refresh_panier();
	});
}

/**
* 	Send a command
*/
 function send_command() 
{
	// AJAX Query for add comand
	$.post(root_path + "commande/add_command/")
	.done(function( data ) {
		var result = JSON.parse(data);
		if (result.status == 1) {
			// OK
			window.location = root_path + "home/index";
			display_message("success", "La commande à bien été pris en compte");
			drop_all_panier();
		} else {
			// NOK
			alert(result.error);
		}
	});
}