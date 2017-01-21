<?php
include 'header.php';
include 'admin/connexion.php';
session_start();
?>
<body class="index">
	<header class="index-header">
	<img src="img/logo.png">
	</header>
	<nav >
		<ul>
			<li><a href="index.php">Accueil</a></li>
			<li><a href="homme.php">Homme</a></li>
			<li><a class="active" href="femme.php">Femme</a></li>
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
	<?php
				$query = "SELECT p.* FROM product AS p, categorie_product AS cp WHERE cp.id_categorie ='2' AND cp.id_produit = p.id";
				if ($res = mysqli_query($bdd, $query)) {
					while ($row = mysqli_fetch_assoc($res)) {
						echo '<div class="col-md-2" style="margin-left: 50px"><img src="img/product.jpg"><br />'.$row['nom'].'  -  '.$row['price'].'€
						<form action="ajout_produit.php" method="POST">
							<input type="number" style="width: 100px; display: inline-table;" name="quantity" value="1"></input>
							<button style="float:right;" type="submit" name="add" value="'.$row['id'].'"><i class="fa fa-plus"></i></button>
						</form>
						<br />
						'.$row['description'].'
						</div>';
					}
				}
			?>
</body>
<?php
include 'footer.php';
?>