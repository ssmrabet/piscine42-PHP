<?php
if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] && $_POST['submit'] === "OK") {
	$compte = unserialize(file_get_contents('../private/passwd'));
	$rep = 0;
	if ($compte) {
		foreach ($compte as $i => $p) {
			if ($p['login'] == $_POST['login'] && $p['passwd'] == hash('whirlpool', $_POST['oldpw'])) {
				$compte[$i]['passwd'] = hash('whirlpool', $_POST['newpw']);
				$rep = 1;
			}
		}
		if ($rep) {
			file_put_contents('../private/passwd', serialize($compte));
			echo "OK\n";
			header('location: index.html');
		}
		else
			echo "ERROR\n";
	}
	else
		echo "ERROR\n";
}
else
	echo "ERROR\n";
?>
