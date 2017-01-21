<?php
include 'header.php';
?>
<body class="bg-red">
	<img class="img_titre" src="img/logo.png" alt="" title="e'closet">
	<div>
		<section class="bg-white panel">
			<header class="text-center panel-header">
				<strong>Connexion</strong>
			</header>
			<form class="panel-body" action="login.php" method="POST">
				<div class="form-group">
					<label>Identifiant</label>
					<input name="id" type="text" placeholder="Adresse mail..."></input>
				</div>
				<button type="submit">Envoyer code de réinitialisation</button>
				<a class="pass" href="forget.php">Modifier le mot de passe</a>
			</form>
			<hr />
			<div class="panel-body">				
				<a href="create.php"><button class="btn bg-red">Créer un compte</button></a>
			</div>
		</section>
	</div>

<?php
include 'footer.php';	
?>
