<?php
	include 'admin/connexion.php';
	include 'function_panier.php';
	session_start();
	if (isset($_SESSION['id']))
	{
		$query = "SELECT c.* FROM commande AS c, user AS u, commande_product_user AS cpu WHERE cpu.id_user ='".$_SESSION['id']."'
		AND c.date_paiement = '0000-00-00 00:00:00' AND u.email = cpu.id_user AND c.id = cpu.id_commande;";
		if ($res = mysqli_query($bdd, $query)) {
			$row = mysqli_fetch_assoc($res);
			$id_com = $row['id'];
		}
		else {
			$id_com = str_shuffle(0123456789);
			$res = mysqli_query($bdd, "INSERT INTO commande (`id`, `date_creation`, `price`) SET ('" . $id_com . "', '" . date("Y-m-d H:i:s") . "', '0');");
		}
		//verification de disponibilité de produit
		$rep = 0;
		$query = "SELECT * FROM commande_product_user WHERE id_commande = '" . $id_com . "' AND id_user='" . $_SESSION['id'] . "' AND id_product = '" . $_POST['add'] . "'";
		if ($res = mysqli_query($bdd, $query)) {
			$row = mysqli_fetch_assoc($res);
			if ($row['id'] != "")
				$rep = 1;
		}
		if ($rep == 0)
		{
			//ajouter le produit a la commande
			$res = mysqli_query($bdd, "INSERT INTO `commande_product_user`(`id_commande`, `id_user`, `id_product`, `quantity`) VALUES
			('" . $id_com . "', '" . $_SESSION['id'] . "', '" . $_POST['add'] . "', '" . $_POST['quantity'] . "');");
		}
		else
		{
			$qu = $row['quantity'] + $_POST['quantity'];
			$res = mysqli_query($bdd, "UPDATE `commande_product_user` SET `quantity`= '".$qu."' WHERE `id_commande`='" . $id_com . "'
			AND `id_product`='" . $_POST['add'] . "' AND `id_user`='" . $_SESSION['id'] . "';");
		}
		//prix produit
		$query = "SELECT price FROM product WHERE id = '".$_POST['add']."'";
		if ($res = mysqli_query($bdd, $query)) {
			$row = mysqli_fetch_assoc($res);
			$p = $row['price'];
		}
		//prix commande initiale
		$query = "SELECT price FROM commande WHERE id = '".$id_com."'";
		if ($res = mysqli_query($bdd, $query)) {
			$row = mysqli_fetch_assoc($res);
			$s = $row['price'];
		}
		//modifier prix commande
		$price = $s + $p * $_POST['quantity'];
		$res = mysqli_query($bdd, "UPDATE `commande` SET `price`= '".$price."' WHERE `id`='" . $id_com . "';");
	}
	else {
		makePanier();
		//prix produit
		$query = "SELECT price FROM product WHERE id = '".$_POST['add']."'";
		if ($res = mysqli_query($bdd, $query)) {
			$row = mysqli_fetch_assoc($res);
			$p = $row['price'];
		}
		$tab = array('refProduit'=>$_POST['add'], 'prixProduit'=>$p, 'qProduit'=>$_POST['quantity']);
		$_SESSION['panier'][] = $tab;
	}
	header('location: panier.php');
?>