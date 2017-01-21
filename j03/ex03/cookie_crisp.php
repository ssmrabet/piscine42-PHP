<?php
if ($_GET['action'] == "set") {
	if ($_GET['name'] && $_GET['value'])
		setcookie($_GET['name'], $_GET['value'], time() + 3600);
}
else if ($_GET['action'] == "get") {
	if ($_GET['name'] && $_COOKIE[$_GET['name']] && !$_GET['value'])
		echo $_COOKIE[$_GET['name']]."\n";
}
else if ($_GET['action'] == "del") {
	if ($_GET['name'] && !$_GET['value'])
		setcookie($_GET['name'], NULL, -1);
}
?>
