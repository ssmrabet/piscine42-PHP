<?php
//connexion a la bdd
include('admin/connexion.php');

//requete sql
if (isset($_POST['']))
	$res = mysqli_query($bdd, 'SELECT code FROM user WHERE email="' . $_POST['email'] .'";');

//get info
$row = mysqli_fetch_assoc($res);
echo $row['nom'];
?>
