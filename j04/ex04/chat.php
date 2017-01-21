<?php
session_start();
if (!($_SESSION['loggued_on_user']))
	echo "ERROR\n";
else {
	if (file_exists('../private') && file_exists('../private/chat')) {
		$text = unserialize(file_get_contents('../private/chat'));
		foreach ($text as $msg) {
			echo "[".date('H:i',$msg['time'])."] <b>".$msg['login']."</b>: ".$msg['msg']."<br />";
			echo "\n";
		}
	}
}
?>
