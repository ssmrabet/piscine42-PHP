<?php
include 'header.php';
include 'admin/connexion.php';
include 'function_panier.php';
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
			<li><a href="femme.php">Femme</a></li>
			<li><a href="boutique.php">Nos boutiques</a></li>
			<?php
			if (!isset($_SESSION['id']))
				echo '<li style="float:right"><a href="login.php">Connexion</a></li>';
			else
				echo '<li style="float:right"><a href="login.php?destroy">Déconnexion</a></li>';
			?>
			<li style="float:right"><a  class="active" href="panier.php"><i class="fa fa-shopping-cart"></i> Panier</a></li>
		</ul>
	</nav>
<div class="col-md-12">
<table class="text-center">
<?php
if (isset($_SESSION['id']))
{
	$query = "SELECT c.*,u.* FROM commande AS c, user AS u, commande_product_user AS cpu WHERE cpu.id_user ='".$_SESSION['id']."'
	AND c.date_paiement = '0000-00-00 00:00:00' AND u.email = cpu.id_user AND c.id = cpu.id_commande;";
	if ($res = mysqli_query($bdd, $query)) {
		$row = mysqli_fetch_assoc($res);
		echo '<tr><th class="pad">ID Commande</th><td class="pad">'.$row['id'].'</td><td colspan="4"></td></tr>';
		echo '<tr><th class="pad">Nom Client</th><td class="pad">'.$row['nom'].' '.$row['prenom'].'</td colspan="4"></td></tr>';
		echo '<tr><th class="pad">Date et Heure de la Création</th><td class="pad">'.$row['date_creation'].'</td colspan="4"></td></tr>';
		echo '<tr><th class="pad">Date et Heure de Paiement</th><td class="pad">'.$row['date_paiement'].'</td><td colspan="4"></td></tr>';
		echo '<tr><th class="pad">Produits</th><td>Prix</td><td class="pad">Quantity</td><td class="pad">Prix totale du produit</td></tr>';
		$r2 = mysqli_query($bdd, "SELECT DISTINCT cpu.quantity, p.nom, p.price, p.id FROM product AS p, commande_product_user AS cpu, user AS u WHERE cpu.id_product = p.id AND
		cpu.id_user = '".$row['email']."' AND cpu.id_commande = '".$row['id']."';");
		$t = 0;
		while ($product = mysqli_fetch_assoc($r2))
		{
			echo '<tr >';
			echo '<td class="pad">'.$product['nom'].'</td>';
			echo '<td class="pad">'.$product['price'].'</td>';
			echo '<td class="pad">'.$product['quantity'].'</td>';
			$equation = $product['quantity']."*".$product['price'];
			$p = eval('return '.$equation.';');
			$t += $p;
			echo '<td class="pad">'.$p.'</td>';
			if ($product['quantity'] > 1)
				echo '<td class="pad"><a href="update.php?id_product='.$product['id'].'&id_commande='.$row['id'].'"><button name"update" value="update"><i class="fa fa-minus"></i></button></td>';
			echo '<td class="pad"><a href="delete_product.php?id_product='.$product['id'].'&id_commande='.$row['id'].'&quantity='.$product['quantity'].'"><button class="bg-red" name"delete" value="delete"><i class="fa fa-trash"></i></button></td>';
			echo '</tr>';
		}
		echo '<tr><th>Totale</th><td colspan="2"></td><td><b>'.$t.'</b></td></tr>';
	}
}
else
{
	if (!$_SESSION['panier'])
		makePanier();
	else
	{
		echo '<tr><th class="pad">Produits</th><td>Prix</td><td class="pad">Quantity</td></tr>';
		$t = 0;	
		foreach ($_SESSION['panier'] as $k) {
			echo '<form action="update.php" method="POST"><tr>';
			if ($k != "")
			{
				$i=1;
				foreach ((array)$k as $p)
				{
					
					if($i == 3)
						$t += $p * $q;
					if ($i == 2)
						$q = $p;
					echo '<td class="pad"><input readonly type="text" name="k'.$i.'" value="'.$p.'"></td>';
					echo "k".$i;
					$i++;
				}
				echo "\n";
				echo '<td class="pad"><button type="submit" value="upd" name="upd"><i class="fa fa-minus"></i></button>';
				echo '</form></tr>';
			}
		}
		echo '<tr><th>Totale</th><td colspan="2"></td><td><b>'.$t.'</b></td></tr>';
	}
}
?>
</table>
</div>
<br />

<?php
if (isset($_SESSION['id']))
	echo '<button type="submit" name="paye" value="save">Payer</button>';
else
	echo '<a href="login.php"><button type="submit" name="connexion" value="save">Connexion</button></a>';
?>
</body>
<?php
include 'footer.php';
?>