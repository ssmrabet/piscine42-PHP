<?php
include ('admin/connexion.php');
?>
<html lang="fr" class="bg-danger">
<head>
<meta charset="UTF-8">
<meta name="description" content="admin, dashboard">
<title>Administration</title>

<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="bg-red">
	<img class="img_titre" src="img/logo.png" alt="" title="e'closet">
	<div>
		<section class="bg-white panel">

			<header class="text-center panel-header">
				<strong>Inscription</strong>
			</header>
			<?php
			if (isset($_POST['nom'], $_POST['prenom'], $_POST['pwd'], $_POST['pwd1'], $_POST['email'], $_POST['cpostal']))
			{
				if ($_POST['pwd'] == $_POST['pwd1'])
				{
					if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
					{
						$nom = mysqli_real_escape_string($bdd, $_POST['nom']);
						$prenom = mysqli_real_escape_string($bdd, $_POST['prenom']);
						$pwd = mysqli_real_escape_string($bdd, hash('whirlpool', $_POST['pwd']));
						$email = mysqli_real_escape_string($bdd, $_POST['email']);
						$cpostal = mysqli_real_escape_string($bdd, $_POST['cpostal']);
						$access = hash('whirlpool', str_shuffle('abcdefg12345'));
						$function = "user";
						$rnb = mysqli_num_rows(mysqli_query($bdd, 'SELECT * FROM user WHERE email="'. $email .'"'));
						if ($rnb == 0)
						{
							$code = $rnb + 1;
							if (mysqli_query($bdd, 'INSERT INTO `user`(`email`, `pwd`, `nom`, `prenom`, `code_postal`, `code`, `access`, `function`) VALUES ("'. $email .'", "'. $pwd .'", "'. $nom .'", "'. $prenom .'", "'. $cpostal .'", "'. $code .'", "'. $access .'", "'. $function .'")'))
							{
								$error = FALSE;
							}
							else
							{
								$error = TRUE;
								$message = 'Une erreur est survenue pendant l\'inscription.';
							}
						}
						else {
							$error = true;
							$message = 'Cette email &aacute d&eacute &eacutet&eacute utilis&eacute';
						}
					}
					else {
						$error = true;
						$message = 'L\'email n\'est pas valide.';
					}
				}
				else {
					$error = true;
					$message = 'Les mots de passe que vous avez entr&eacute; ne sont pas identiques.';
				}
			}
			else
			{
				$error = TRUE;
			}
			if ($error)
			{
				if (isset($message))
				{
					echo '<div class="message">'.$message.'</div>';
				}
			?>
			<form class="panel-body" action="create.php" method="POST">
				<div class="form-group">
					<label>Nom</label>
					<input name="nom" type="text" placeholder="Nom..."></input>
				</div>
				<div class="form-group">
					<label>Prénom</label>
					<input name="prenom" type="text" placeholder="Prénom..."></input>
				</div>
				<div class="form-group">
					<label>Adresse mail</label>
					<input name="email" type="text" placeholder="Email..."></input>
				</div>
				<div class="form-group">
					<label>Code postal</label>
					<input name="cpostal" type="text" placeholder="Code postal..."></input>
				</div>
				<div class="form-group">
					<label>Mot de passe</label>
					<input name="pwd" type="password" placeholder="*****"></input>
				</div>
				<div class="form-group">
					<label>Vérifier le mot de passe</label>
					<input name="pwd1" type="password" placeholder="*****"></input>
				</div>
				<button name="submit" type="submit">Créer</button>
			</form>
			<?php
			}
			?>
			<hr />
			<div class="panel-body">
				<a href="login.php"><button class="btn bg-red">Se connecter</button></a>
			</div>
		</section>
	</div>

<?php
include 'footer.php';
?>
