#!/usr/bin/php
<?php
$stdin = fopen("php://stdin", "r");
while ($stdin && !feof($stdin)) {
	echo "Entrez un nombre: ";
	$number = fgets($stdin);
	if ($number) {
		$number = substr($number, 0, -1);
		if (strlen($number) && is_numeric($number)) {
			if ($number % 2 == 0)
				echo "Le chiffre ".$number." est Pair\n";
			else
				echo "Le chiffre ".$number." est Impair\n";
		} else
			echo "'".$number."' n'est pas un chiffre\n";
	}
}
fclose($stdin);
echo "\n";
?>
