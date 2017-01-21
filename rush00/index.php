<?php
include 'header.php';

session_start();
?>
<body class="index">
	<header class="index-header">
	<img src="img/logo.png">
	</header>
	<nav >
		<ul>
			<li><a class="active" href="inde.php">Accueil</a></li>
			<li><a href="homme.php">Homme</a></li>
			<li><a href="femme.php">Femme</a></li>
			<li><a href="boutique.php">Nos boutiques</a></li>
			<?php
			if (!isset($_SESSION['id']))
				echo '<li style="float:right"><a href="login.php">Connexion</a></li>';
			else
				echo '<li style="float:right"><a href="login.php?destroy">Déconnexion</a></li>';
			?>
			<li style="float:right"><a href="panier.php"><i class="fa fa-shopping-cart"></i> Panier</a></li>
		</ul>
	</nav>
	
</body>
<?php
include 'footer.php';
?>
