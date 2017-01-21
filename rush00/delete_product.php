<?php
include 'admin/connexion.php';
include 'function_panier.php';
	session_start();
	if (isset($_SESSION['id']))
	{
		//prix produit
		$query = "SELECT price FROM product WHERE id = '".$_GET['id_product']."'";
		if ($res = mysqli_query($bdd, $query)) {
			$row = mysqli_fetch_assoc($res);
			$p = $row['price'];
		}
		//prix commande initiale
		$query = "SELECT price FROM commande WHERE id = '".$_GET['id_commande']."'";
		if ($res = mysqli_query($bdd, $query)) {
			$row = mysqli_fetch_assoc($res);
			$s = $row['price'];
		}
		//modifier prix commande
		$price = $s - ($p * $_GET['quantity']);
		$res = mysqli_query($bdd, "UPDATE `commande` SET `price`= '".$price."' WHERE `id`='" . $_GET['id_commande'] . "';");
		echo "UPDATE `commande` SET `price`= '".$price."' WHERE `id`='" . $_GET['id_commande'] . "';";
		//delete from commande
		$res = mysqli_query($bdd, "DELETE FROM`commande_product_user` WHERE `id_commande`='" . $_GET['id_commande'] . "' AND
		`id_product`='" . $_GET['id_product'] . "' AND `id_user`='" . $_SESSION['id'] . "';");
		echo "DELETE FROM`commande_product_user` WHERE `id_commande`='" . $_GET['id_commande'] . "' AND
		`id_product`='" . $_GET['id_product'] . "' AND `id_user`='" . $_SESSION['id'] . "';";
	}
	else
	{
		delArticle($_GET['id_product']);
	}
	header('location: panier.php');
?>