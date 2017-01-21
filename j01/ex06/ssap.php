#!/usr/bin/php
<?php
$array = array();
unset($argv[0]);
foreach($argv as $arg) {
	$str = array_filter(explode(' ', $arg));
	foreach ($str as $ar)
		$array[] = $ar;
}
sort($array);
foreach ($array as $arg)
	echo $arg."\n";
?>
