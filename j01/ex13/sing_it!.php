#!/usr/bin/php
<?php
if ($argv[1] == "mais pourquoi cette demo ?")
	echo "Tout simplement pour qu'en feuilletant le sujet\non ne s'apercoive pas de la nature de l'exo\n";
else if ($argv[1] == "mais pourquoi cette chanson ?")
	echo "Parce que Kwame a des enfants\n";
else if ($argv[1] == "vraiment ?") {
	$str = array(
		"1"=>"Nan c'est parce que c'est le premier avril",
		"2"=>"Oui il a vraiment des enfants"
	);
	echo $str[rand(1, 2)]."\n";
}
?>
