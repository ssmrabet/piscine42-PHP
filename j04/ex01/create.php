<?php
if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] && $_POST['submit'] == "OK") {
	if (!file_exists('../private')) {
		mkdir("../private");
	}
	if (!file_exists('../private/passwd')) {
		file_put_contents('../private/passwd', null);
	}
	$compte = unserialize(file_get_contents('../private/passwd'));
	if ($compte) {
		$rep = 0;
		foreach ($compte as $p) {
			if ($p['login'] == $_POST['login'])
				$rep = 1;
		}
	}
	if ($rep == 1) {
		echo "ERROR\n";
	} else {
		$tab = array('login'=>$_POST['login'], 'passwd'=>hash('whirlpool', $_POST['passwd']));
		$compte[] = $tab;
		file_put_contents('../private/passwd', serialize($compte));
		echo "OK\n";
	}
} else {
	echo "ERROR\n";
}
?>
