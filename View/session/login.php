<form class="styled-form form-login" id="connexion-form">
	
	<!-- ERROR ZONE -->
	<div id="error-zone">
		
	</div>

	<!-- TITLE -->
	<h2>Veuillez entrer vos identifiants</h2>

	<!-- LOGIN field -->
	<div class="form-item">
		<label for="mail">
			Email
		</label>
		<input type="text" id="mail" placeholder="Votre adresse E-mail ...">
	</div>

	<!-- PASSWORD field -->
	<div class="form-item">
		<label for="mdp">
			Mot de passe
		</label>
		<input type="password" id="mdp" placeholder="Votre mot de passe ...">
	</div>

	<!-- SUBMIT button -->
	<input type="submit" value="Connexion">
	<?php echo '<a href="' . ROOT_PATH . 'session/register">'; ?> Vous n'avez pas encore de compte ?</a>
</form>