#!/usr/bin/php
<?PHP
if ($argc != 2) {
	echo "Incorrect Parameters\n";
	exit(1);
}
$argv[1] = str_replace(" ", "", $argv[1]);
$val1 = intval($argv[1]);
$op = substr($argv[1], strlen($val1), 1);
if ($op == ".") {
	$val1 .= ".";
	$val1 .= intval(substr($argv[1], strlen($val1)));
}
$op = substr($argv[1], strlen($val1), 1);
$val2 = substr($argv[1], strlen($val1) + 1);
if (!is_numeric($val1) || !is_numeric($val2) ||
($op != '+' && $op != '-' && $op != '*' && $op != '/' && $op != '%')) {
	echo "Syntax Error\n";
	exit();
}
eval("echo '$val1'$op'$val2';");
echo "\n";
?>
