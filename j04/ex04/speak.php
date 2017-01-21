<?php
session_start();
if (!($_SESSION['loggued_on_user']))
	echo "ERROR\n";
else {
	if (isset($_POST['submit']) && isset($_POST['msg'])) {
		echo "1";
		if (!file_exists('../private')) {
			mkdir("../private");
		}
		if (!file_exists('../private/chat')) {
			echo "2";
			file_put_contents('../private/chat', null);
		}
		$text = unserialize(file_get_contents('../private/chat'));
		$fopen = fopen('../private/chat', "w");
		flock($fopen, LOCK_EX);
		$tab = array('login'=>$_SESSION['loggued_on_user'], 'time'=>time(), 'msg'=>$_POST['msg']);
		$text[] = $tab;
		file_put_contents('../private/chat', serialize($text));
		fclose($fopen);
	}
echo '
<html>
<head>
</head>
<body>
	<form action="speak.php" method="POST">
		<input type="text" name="msg"/><input type="submit" name="submit" value="OK"/>
	</form>
</body>
</html>'.""."\n";
}
?>
