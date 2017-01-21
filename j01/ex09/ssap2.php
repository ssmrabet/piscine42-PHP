#!/usr/bin/php
<?php
$array = array();
unset($argv[0]);
foreach($argv as $arg) {
	$str = array_filter(explode(' ', $arg));
	foreach ($str as $ar)
		$array[] = $ar;
}
foreach ($array as $arg) {
	if (ctype_alpha($arg))
		$alpha[] = $arg;
	else if (is_numeric($arg))
		$num[] = $arg;
	else
		$other[] = $arg;
}
sort($alpha, SORT_STRING | SORT_FLAG_CASE);
foreach ($alpha as $arg)
	echo $arg."\n";
sort($num, SORT_STRING | SORT_FLAG_CASE);
foreach ($num as $arg)
	echo $arg."\n";
sort($other, SORT_STRING | SORT_FLAG_CASE);
foreach ($other as $arg)
	echo $arg."\n";
?>
