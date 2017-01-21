<?php
require_once('auth.php');
session_start();
if ($_POST['login'] && $_POST['passwd'] && auth($_POST['login'], $_POST['passwd'])){
	$_SESSION['loggued_on_user'] = $_POST['login'];
	echo '<html>
<body>
<iframe height=550px" width="100%" src="chat.php"></iframe>
<iframe height="50px" width="100%" src="speak.php"></iframe>
</body>
</html>';
echo "\n";
} else {
	$_SESSION['loggued_on_user'] = "";
	echo "ERROR\n";
}
?>
