<?php
include 'header.php';
include 'connexion.php';
?>

<?php
//requete SQL
if (isset($_POST['search'])) {
	$query = "SELECT DISTINCT * FROM product WHERE price LIKE '%" . $_POST['text'] . "%' OR id LIKE '%" . $_POST['text'] . "%' 
	OR nom LIKE '%" . $_POST['text'] . "%' OR description LIKE '%" . $_POST['text']."%' OR stock LIKE '%" . $_POST['text'] . "%';";
}
else {
	$query = "SELECT * FROM product ORDER BY id ASC;";
}
//delete
if (isset($_POST['delete']))
{
	$del = mysqli_query($bdd, "DELETE FROM product WHERE id='" . $_POST['id'] . "';");
	header('location: produit.php');
}
//update
if (isset($_POST['submit']))
{
	$upd = mysqli_query($bdd, "UPDATE product SET nom='" . $_POST['nom'] . "', description='" . $_POST['description'] . "', stock='" . $_POST['stock'] . "', 
	price='" . $_POST['price'] . "'	WHERE id='" . $_POST['id'] . "';");
	header('location: produit.php');
}
//add
if (isset($_POST['submit_ajout'])) {
	$add = mysqli_query($bdd, "INSERT INTO `product`(`nom`,`description`,`stock`,`price`) VALUES ('" . $_POST['nom'] . "','" . $_POST['description'] . "','" . $_POST['stock'] . "',
	'" . $_POST['price'] . "');");
	header('location: produit.php');
}
//affect
//add
if (isset($_POST['submit_affect']) && $_POST['sp'] != "" && $_POST['sc'] != "") {
	$ad = mysqli_query($bdd, "INSERT INTO `categorie_product`(`id_categorie`, `id_produit`) VALUES ('" . $_POST['sc'] . "', '" . $_POST['sp'] . "');");
	header('location: produit.php');
}
?>
<form action="produit.php" method="POST">
	<div class="col-md-3"><input class="in" type="text" name="text"></div>
	<div class="col-md-2"><button class="in" type="submt" name="search" value="Recherche">Recherche</button></div>
</form>
<div class="col-md-3"></div>
<div class="col-md-10">
<table>
	<tr>	
	<th>ID</th>
	<th>Nom</th>
	<th>Description</th>
	<th>Stock</th>
	<th>Prix</th>
	<th></th>
	<th></th>
	</tr>
	<?php
if ($res = mysqli_query($bdd, $query)) {
	//get info bdd
	while ($row = mysqli_fetch_assoc($res)) {
		echo '<tr><form action="produit.php" method="POST">';
		echo '<td><input type="text" readonly name="id" value="'.$row['id'].'"></td>';
		echo '<td><input type="text" name="nom" value="'.$row['nom'].'"></td>';
		echo '<td><input type="text" name="description" value="'.$row['description'].'"></td>';
		echo '<td><input type="text" name="stock" value="'.$row['stock'].'"></td>';
		echo '<td><input type="text" name="price" value="'.$row['price'].'"></td>';
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
	<form action="produit.php" method="POST">
		<button class="in  bg-red" name="ajout" value="ajout">Ajouter un produit</button>
		<button class="in  bg-red" name="affect" value="affect">Affecter a une catégorie</button>
	</form>
	<?php
		if (isset($_POST['ajout'])) {
		?>
		<form action="produit.php" method="POST">
			<input required type="text" name="nom" placeholder="Nom...">
			<input resuired type="text" name="description" placeholder="Description...">
			<input required type="number" name="stock" placeholder="Stock...">
			<input required type="number" step="0.01" name="price" placeholder="price...">
			<button name="submit_ajout" value="submit_ajout" type="submit">Ajouter</button>
		</form>
		<?php
		}
		else if (isset($_POST['affect'])) {
			
		?>
		<form action="produit.php" method="POST">
			<select name="sp">
				<option value="">-- Produit --</option>
			<?php
			$quer1 = "SELECT * FROM product ORDER BY id ASC;";
			if ($s_product = mysqli_query($bdd, $quer1)) {
				while ($r1 = mysqli_fetch_assoc($s_product)) {
					echo '<option value="' . $r1['id'] . '">' . $r1['nom'] . '</option>';
				}
			}
			mysqli_free_result($r1);
			?>
			</select>
			<select name="sc">
				<option value="">-- Catégorie --</option>
			<?php
			$quer2 = "SELECT * FROM categorie ORDER BY id ASC;";
			if ($s_category = mysqli_query($bdd, $quer2)) {
				while ($r2 = mysqli_fetch_assoc($s_category)) {
					echo '<option value="' . $r2['id'] . '">' . $r2['nom'] . '</option>';
				}
			}
			mysqli_free_result($r2);
			?>
			</select>
			<button name="submit_affect" value="submit_affect" type="submit">Affecter</button>
		</form>
		<?php
		}
	?>
</div>
<?php
include 'footer.php';	
?>
