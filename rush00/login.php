<?php
include ('header.php');
include ('admin/connexion.php');
session_start();
if (isset($_GET["destroy"])) {
	session_destroy();
	header ('location: index.php');
}
?>
<body class="bg-red">
	<img class="img_titre" src="img/logo.png" alt="" title="e'closet">
	<div>
		<section class="bg-white panel">
			<header class="text-center panel-header">
				<strong>Connexion</strong>
			</header>
			<?php
			if (isset($_POST['email'], $_POST['pwd']))
			{
				$email = mysqli_real_escape_string($bdd, $_POST['email']);
				$pwd = hash('whirlpool', $_POST['pwd']);
				$checkid_email = mysqli_query($bdd, 'SELECT * from user where email="' . $email . '";');
				$rnb = mysqli_fetch_array($checkid_email);
				if ($rnb['pwd']== $pwd && mysqli_num_rows($checkid_email) > 0)
				{
					$error = FALSE;
					$_SESSION['id'] = $_POST['email'];
					$_SESSION['name'] = $rnb['prenom'];
					if ($rnb['function'] == "admin")
					{
						echo $_SESSION['function'];
						$_SESSION['function'] = $_POST['function'];
						header('location: admin/dashboard.php');
					}
					else
						header('location: index.php');
				}
				else {
					$error = TRUE;
					$message = 'La combinaison email/mot de passe n\'est pas bonne.';
				}
			}
			else {
				$error = TRUE;
			}
			if ($error)
			{
				if (isset($message))
				{
					 echo '<div class="message">'.$message.'</div>';
				}
			?>
			<form class="panel-body" action="login.php" method="POST">
				<div class="form-group">
					<label>Identifiant</label>
					<input name="email" type="text" placeholder="Adresse mail.."></input>
				</div>
				<div class="form-group">
					<label>Mot de passe</label>
					<input name="pwd" type="password" placeholder="*****"></input>
				</div>
				<button type="submit">Se connecter</button>
				<a class="pass" href="forget.php">J'ai oublier mon mot de passe</a>
			</form>
			<?php
			}
			mysqli_close($bdd);
			?>
			<hr />
			<div class="panel-body">
				<a href="create.php"><button class="btn bg-red">Créer un compte</button></a>
			</div>
		</section>
	</div>

<?php
include 'footer.php';
?>