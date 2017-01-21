#!/usr/bin/php
<?php
if ($argc == 2) {
	$array = array_filter(explode(' ', $argv[1]));
	$str = "";
	foreach($array as $arg)
		$str .= $arg." ";
	echo trim($str)."\n";
}
?>
