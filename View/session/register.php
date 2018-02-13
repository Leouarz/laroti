<form class="styled-form form-register" id="register-form">
	
	<!-- ERROR ZONE -->
	<div id="error-zone">
		
	</div>
	
	<!-- TITLE -->
	<h2>Veuillez entrer vos identifiants</h2>

	<!-- NAME field -->
	<div class="form-item">
		<div class="form-half-item">
			<label for="nom">
				Nom
			</label>
			<input type="text" id="nom" placeholder="Votre nom ...">
		</div>
		<div class="form-half-item">
			<label for="prenom">
				Prénom
			</label>
			<input type="text" id="prenom" placeholder="Votre prénom ...">
		</div>
	</div>

	<!-- LOGIN field -->
	<div class="form-item">
		<label for="mail">
			Email
		</label>
		<input type="text" id="mail" placeholder="Votre adresse E-mail ...">
	</div>

	<!-- LOGIN field -->
	<div class="form-item">
		<label for="adresse">
			Adresse
		</label>
		<input type="text" id="adresse" placeholder="Votre adresse ...">
	</div>

	<!-- LOGIN field -->
	<div class="form-item">
		<div class="form-half-item">
			<label for="CP">
				Code Postal
			</label>
			<input type="text" id="CP" placeholder="Votre CP ...">
		</div>
		<div class="form-half-item">
			<label for="ville">
				Ville
			</label>
			<input type="text" id="ville" placeholder="Votre ville ...">
		</div>
	</div>

	<!-- PASSWORD field -->
	<div class="form-item">
		<label for="mdp">
			Mot de passe
		</label>
		<input type="password" id="mdp" placeholder="Votre mot de passe ...">
	</div>

	<!-- SUBMIT button -->
	<input type="submit" value="Inscription">
	<?php echo '<a href="' . ROOT_PATH . 'session/login">'; ?>Vous avez déjà un compte ?</a>
</form>