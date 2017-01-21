<html lang="fr" class="bg-danger">
<head>
<meta charset="UTF-8">
<meta name="description" content="admin, dashboard">
<title>Administration</title>

<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<?php
session_start ();
if (isset($_GET["destroy"])) {
	session_destroy();
	header ('location: ../index.php');
}
if (!isset($_SESSION['id']) || !isset($_SESSION['name']) || !isset($_SESSION['function'])) {
	//header('location: ../login.php');
	echo $_SESSION['id'];
	echo $_SESSION['name'];
	echo $_SESSION['function'];
}
?>
<body>
	<div class="top">
		<div class="col-md-2"><img src="../img/logo.png"></div>
		<div class="col-md-1 col-md-offset-1 menu"><i class="fa fa-tachometer"></i><br /><a href="dashboard.php">Dashboard</a></div>   
		<div class="col-md-1 menu"><i class="fa fa-users"></i><br /><a href="user.php">Utilisateurs</a></div>  
		<div class="col-md-1 menu"><i class="fa fa-opencart"></i><br /><a href="commande.php">Commande</a></div>  
		<div class="col-md-1 menu"><i class="fa fa-link"></i><br /><a href="categorie.php">Catégorie</a></div>
		<div class="col-md-1 menu"><i class="fa fa-product-hunt"></i><br /><a href="produit.php">Produit</a></div>  
		<div class="col-md-1 col-md-offset-2 menu nav"><i class="fa fa-user"></i>  <?php echo $_SESSION['name']; ?></div>
		<div class="col-md-1 menu nav nav-right"><a href="dashboard.php?destroy">Déconnexion</a></div>
	</div>
	<div class="col-ms-12 container">