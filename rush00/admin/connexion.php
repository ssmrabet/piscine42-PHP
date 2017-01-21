<?php
	//connection bdd
	$bdd = mysqli_connect('localhost', 'root', '', 'rush');
	if (mysqli_connect_errno($bdd)) {
		echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}
?>