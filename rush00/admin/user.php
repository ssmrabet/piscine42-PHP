<?php
include 'header.php';
include 'connexion.php';
?>

<?php
//requete SQL
if (isset($_POST['search'])) {
	$query = "SELECT DISTINCT * FROM user WHERE email LIKE '%" . $_POST['text'] . "%' OR nom LIKE '%" . $_POST['text'] . "%'OR prenom LIKE '%" . $_POST['text'] . "%' 
	OR code_postal LIKE '%" . $_POST['text'] . "%';";
}
else {
	$query = "SELECT * FROM user;";
}

if (isset($_POST['delete']))
{
	$res = mysqli_query($bdd, "DELETE FROM user WHERE email='" . $_POST['email'] . "';");
	header('location: user.php');
}

if (isset($_POST['submit']))
{
	$upd = mysqli_query($bdd, "UPDATE user SET nom='" . $_POST['nom'] . "', prenom='" . $_POST['prenom'] . "', code_postal='" . $_POST['code'] . "' WHERE email='" . $_POST['email'] . "';");
	header('location: user.php');
}
?>
<form action="user.php" method="POST">
	<div class="col-md-3"><input class="in" type="text" name="text"></div>
	<div class="col-md-2"><button class="in" type="submt" name="search" value="Recherche">Recherche</button></div>
</form>
<div class="col-md-12">
<table>
	<tr>	
	<th>Email</th>
	<th>Nom</th>
	<th>Prénom</th>
	<th>Code postal</th>
	<th></th>
	<th></th>
	</tr>
	<?php
if ($res = mysqli_query($bdd, $query)) {
	//get info bdd
	while ($row = mysqli_fetch_assoc($res)) {
		echo '<tr><form action="user.php" method="POST">';
		echo '<td><input type="text" readonly name="email" value="'.$row['email'].'"></td>';
		echo '<td><input type="text" name="nom" value="'.$row['nom'].'"></td>';
		echo '<td><input type="text" name="prenom" value="'.$row['prenom'].'"></td>';
		echo '<td><input type="text" name="code" value="'.$row['code_postal'].'"></td>';
		echo '<td><button name="submit" value="submit" type="submit"><i class="fa fa-pencil" title="Modification"></i></button></td>';
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
