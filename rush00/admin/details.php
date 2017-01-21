<?php
include 'header.php';
include 'connexion.php';
?>
<div class="col-md-12">
<table class="text-center">
	<?php
$query = "SELECT * FROM commande WHERE id ='".$_GET['id']."';";
if ($res = mysqli_query($bdd, $query)) {
	//get info bdd
	$row = mysqli_fetch_assoc($res);
		$r1 = mysqli_query($bdd, "SELECT * FROM user AS u, commande_product_user AS c WHERE c.id_user = u.email AND c.id_commande='" . $row['id'] . "';");
		$user = mysqli_fetch_assoc($r1);
		echo '<tr><th class="pad">ID Commande</th><td class="pad">'.$row['id'].'</td><td colspan="4"></td></tr>';
		echo '<tr><th class="pad">Nom Client</th><td class="pad">'.$user['nom'].' '.$user['prenom'].'</td colspan="4"></td></tr>';
		echo '<tr><th class="pad">Date et Heure de la Création</th><td class="pad">'.$row['date_creation'].'</td colspan="4"></td></tr>';
		echo '<tr><th class="pad">Date et Heure de Paiement</th><td class="pad">'.$row['date_paiement'].'</td><td colspan="4"></td></tr>';
		echo '<tr><th class="pad">Produits</th><td>Prix</td><td class="pad">Quantity</td><td class="pad">Prix totale du produit</td></tr>';
		$r2 = mysqli_query($bdd, "SELECT DISTINCT cpu.quantity, p.nom, p.price FROM product AS p, commande_product_user AS cpu, user AS u WHERE cpu.id_product = p.id AND
		cpu.id_user = '".$user['email']."' AND cpu.id_commande = '".$row['id']."';");
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
			echo '</tr>';
		}
		echo '<tr><th>Totale</th><td colspan="2"></td><td><b>'.$t.'</b></td></tr>';
}
mysqli_free_result($res);
?>
</table>
</div>
<?php
include 'footer.php';	
?>