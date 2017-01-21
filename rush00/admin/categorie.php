<?php
include 'header.php';
include 'connexion.php';
?>

<?php
//requete SQL
if (isset($_POST['search'])) {
	$query = "SELECT DISTINCT * FROM categorie WHERE id LIKE '%" . $_POST['text'] . "%' OR nom LIKE '%" . $_POST['text'] . "%';";
}
else {
	$query = "SELECT * FROM categorie;";
}
//delete
if (isset($_POST['delete']))
{
	$del = mysqli_query($bdd, "DELETE FROM categorie WHERE id='" . $_POST['id'] . "';");
	header('location: categorie.php');
}
//update
if (isset($_POST['submit']))
{
	$upd = mysqli_query($bdd, "UPDATE categorie SET nom='" . $_POST['nom'] . "' WHERE id='" . $_POST['id'] . "';");
	header('location: categorie.php');
}
//add
if (isset($_POST['submit_ajout']) && isset($_POST['categorie']) && $_POST['categorie'] != "") {
	$add = mysqli_query($bdd, "INSERT INTO `categorie`(`nom`) VALUES ('" . $_POST['categorie'] . "');");
	header('location: categorie.php');
}

?>
<form action="categorie.php" method="POST">
	<div class="col-md-3"><input class="in" type="text" name="text"></div>
	<div class="col-md-2"><button class="in" type="submt" name="search" value="Recherche">Recherche</button></div>
</form>
<div class="col-md-3"></div>
<div class="col-md-10">
<table>
	<tr>	
	<th>ID</th>
	<th>Nom</th>
	<th></th>
	<th></th>
	</tr>
	<?php
if ($res = mysqli_query($bdd, $query)) {
	//get info bdd
	while ($row = mysqli_fetch_assoc($res)) {
		echo '<tr><form action="categorie.php" method="POST">';
		echo '<td><input type="text" readonly name="id" value="'.$row['id'].'"></td>';
		echo '<td><input type="text" name="nom" value="'.$row['nom'].'"></td>';
		echo '<td><button name="submit" value="submit" type="submit"><i class="fa fa-pencil" title="Modification"></i></button></td>';
		echo '<td><button class="bg-red" name="delete" value="delete" type="submit"><i class="fa fa-trash" title="Suppression"></i></button></a></td>';
		echo '</form></tr>';
	}
}
mysqli_free_result($res);
?>
</table>
</div>
<div class="col-md-2">
	<form action="categorie.php" method="POST"><button class="in  bg-red" name="ajout" value="ajout">Ajouter une catégorie</button></form>
	<?php
		if (isset($_POST['ajout'])) {
		?>
		<form action="categorie.php" method="POST">
			<input type="text" required name="categorie" placeholder="Categorie...">
			<button name="submit_ajout" value="submit_ajout" type="submit">Ajouter</button>
		</form>
		<?php
		}
	?>
</div>
<?php
include 'footer.php';	
?>
