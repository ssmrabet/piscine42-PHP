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
		
		$qu = 0;
		//initial quantity product
		$query = "SELECT quantity FROM commande_product_user WHERE id_commande = '".$_GET['id_commande']."' AND `id_user`='" . $_SESSION['id'] . "' 
		AND `id_product`='" . $_GET['id_product'] . "'";
		if ($res = mysqli_query($bdd, $query)) {
			$row = mysqli_fetch_assoc($res);
			$qu = $row['quantity'];
		}
		//modifier prix commande
		$price = $s - $p;
		$qu--;
		$res = mysqli_query($bdd, "UPDATE `commande` SET `price`= '".$price."' WHERE `id`='" . $_GET['id_commande'] . "';");
		echo "UPDATE `commande` SET `price`= '".$price."' WHERE `id`='" . $_GET['id_commande'] . "';";
		//update quantity product
		$res = mysqli_query($bdd, "UPDATE `commande_product_user` SET `quantity`= '".$qu."' WHERE `id_commande`='" . $_GET['id_commande'] . "' AND
		`id_user`='" . $_SESSION['id'] . "' AND `id_product`='" . $_GET['id_product'] . "';");
	}
	else
	{
		modifArticle($_POST['k1'],$_POST['k3']);
	}
	header('location: panier.php');
?>