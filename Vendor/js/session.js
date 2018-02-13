//	Try a connection
$("#connexion-form").submit(function(e){
	var mail = $("#mail").val();
	var mdp = $("#mdp").val();

    login(mail, mdp);

    return false;
});

//	Try a connection
$("#register-form").submit(function(e){
	var nom 	= $("#nom").val();
	var prenom 	= $("#prenom").val();
	var adresse = $("#adresse").val();
	var cp 		= $("#CP").val();
	var ville 	= $("#ville").val();
	var mail 	= $("#mail").val();
	var mdp 	= $("#mdp").val();

    register(nom, prenom, adresse, cp, ville, mail, mdp);

    return false;
});

/**
* 	Account login query
*/
function login(mail, mdp) 
{
	// AJAX Query for add to cart
	$.post(root_path + "session/connect/", {mail: mail, mdp: mdp})
	.done(function( data ) {
		var data 		= JSON.parse(data);
		var error 		= data.error;
		var html_error	= "<ul>";

		if (data.status) {
			window.location = root_path + "home/index";
		}

		// IF problem with mail
		if (error.email) {
			// NOK
			$("#mail").toggleClass("red");
			html_error += "<li><strong>Email :</strong> " + error.email + "</li>";
		} else {
			// OK
			$("#mail").toggleClass("");
		}

		// IF problem with mdp
		if (error.mdp) { 
			// NOK
			$("#mdp").toggleClass("red");
			html_error += "<li><strong>MDP :</strong> " + error.mdp + "</li>";
		} else {
			// OK
			$("#mdp").toggleClass("");
		}

		// IF problem with cred
		if (error.credentials) {
			// NOK
			html_error += "<li><strong>Erreur :</strong> " + error.credentials + "</li>";
		}

		html_error += "<ul>";
		$("#error-zone").html(html_error);
	});
}

/**
* 	Request a registration
*/
function register(nom, prenom, adresse, cp, ville, mail, mdp) 
{
	// Make an ajax query for the registration
	$.post(root_path + "session/signup/", {nom, prenom, adresse, cp, ville, mail, mdp})
	.done(function( data ) {

		console.log(data);

		var data 		= JSON.parse(data);
		var error 		= data.error;
		var html_error	= "<ul>";

		if (data.status) {
			window.location = root_path + "session/login";
		}

		// IF problem with mail
		if (error.mail) {
			// NOK
			$("#mail").toggleClass("red");
			html_error += "<li><strong>Email :</strong> " + error.mail + "</li>";
		} else {
			// OK
			$("#mail").toggleClass("");
		}

		// IF problem with mdp
		if (error.mdp) { 
			// NOK
			$("#mdp").toggleClass("red");
			html_error += "<li><strong>MDP :</strong> " + error.mdp + "</li>";
		} else {
			// OK
			$("#mdp").toggleClass("");
		}

		// IF problem with nom
		if (error.nom) { 
			// NOK
			$("#nom").toggleClass("red");
			html_error += "<li><strong>Nom :</strong> " + error.nom + "</li>";
		} else {
			// OK
			$("#nom").toggleClass("");
		}

		// IF problem with adresse
		if (error.adresse) { 
			// NOK
			$("#adresse").toggleClass("red");
			html_error += "<li><strong>Adresse :</strong> " + error.adresse + "</li>";
		} else {
			// OK
			$("#adresse").toggleClass("");
		}

		// IF problem with cp
		if (error.cp) { 
			// NOK
			$("#CP").toggleClass("red");
			html_error += "<li><strong>Code Postal :</strong> " + error.cp + "</li>";
		} else {
			// OK
			$("#CP").toggleClass("");
		}

		// IF problem with ville
		if (error.ville) { 
			// NOK
			$("#ville").toggleClass("red");
			html_error += "<li><strong>Ville :</strong> " + error.ville + "</li>";
		} else {
			// OK
			$("#ville").toggleClass("");
		}

		// IF problem with prenom
		if (error.prenom) { 
			// NOK
			$("#prenom").toggleClass("red");
			html_error += "<li><strong>Prénom :</strong> " + error.prenom + "</li>";
		} else {
			// OK
			$("#prenom").toggleClass("");
		}

		html_error += "<ul>";
		$("#error-zone").html(html_error);
	});
}