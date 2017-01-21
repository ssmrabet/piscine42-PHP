<?php
include 'header.php';
include 'connexion.php';
?>

<?php
//requete SQL
if (isset($_POST['search'])) {
	$query = "SELECT DISTINCT * FROM commande WHERE price LIKE '%" . $_POST['text'] . "%' OR id LIKE '%" . $_POST['text'] . "%' ORDER BY date_creation DESC;";
}
else {
	$query = "SELECT * FROM commande ORDER BY date_creation DESC;";
}

if (isset($_POST['delete']))
{
	$res = mysqli_query($bdd, "DELETE FROM commande WHERE id='" . $_POST['id'] . "';");
	header('location: commande.php');
}

if (isset($_POST['submit']))
{
	header('location: details.php?id='.$_POST['id']);
}
?>
<form action="commande.php" method="POST">
	<div class="col-md-3"><input class="in" type="text" name="text"></div>
	<div class="col-md-2"><button class="in" type="submt" name="search" value="Recherche">Recherche</button></div>
</form>
<div class="col-md-12">
<table>
	<tr>	
	<th>ID</th>
	<th>Nom</th>
	<th>Prénom</th>
	<th>Date création</th>
	<th>Date paiement</th>
	<th>Prix</th>
	<th></th>
	<th></th>
	</tr>
	<?php
if ($res = mysqli_query($bdd, $query)) {
	//get info bdd
	while ($row = mysqli_fetch_assoc($res)) {
		$r = mysqli_query($bdd, "SELECT * FROM user AS u, commande_product_user AS c WHERE c.id_user = u.email AND c.id_commande='" . $row['id'] . "';");
		$user = mysqli_fetch_assoc($r);
		echo '<tr><form action="commande.php" method="POST">';
		echo '<td><input type="text" readonly name="id" value="'.$row['id'].'"></td>';
		echo '<td><input type="text" name="nom" value="'.$user['nom'].'"></td>';
		echo '<td><input type="text" name="prenom" value="'.$user['prenom'].'"></td>';
		echo '<td><input type="text" name="date_creation" value="'.$row['date_creation'].'"></td>';
		echo '<td><input type="text" name="date_paiement" value="'.$row['date_paiement'].'"></td>';
		echo '<td><input type="text" name="price" value="'.$row['price'].'"></td>';
		echo '<td><button name="submit" value="submit" type="submit"><i class="fa fa-plus-circle" title="Détails"></i></button></td>';
		echo '<td><button class="bg-red" name="delete" value="delete" type="submit"><i class="fa fa-trash" title="Suppression"></i></button></a></td>';
		echo '</form></tr>';
	}
}
mysqli_free_result($res);
?>
</table>
</div>
<?php
include 'footer.php';	
?>