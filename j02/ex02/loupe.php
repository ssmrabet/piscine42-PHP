#!/usr/bin/php
<?php
if ($argc < 2 || !file_exists($argv[1]))
	exit();
unset($argv[0]);
foreach($argv as $arg)
{
	if (file_exists($arg))
	{
		$file = fopen($arg, 'r');
		$text = "";
		while ($file && !feof($file)) {
			$text .= fgets($file);
		}
		$text = preg_replace_callback("/(<a )(.*?)(>)(.*)(<\/a>)/si", function($res) {
			$res[0] = preg_replace_callback("/( title=\")(.*?)(\")/mi", function($res) {
				return ($res[1]."".strtoupper($res[2])."".$res[3]);
			}, $res[0]);
			$res[0] = preg_replace_callback("/(>)(.*?)(<)/si", function($res) {
				return ($res[1]."".strtoupper($res[2])."".$res[3]);
			}, $res[0]);
			return ($res[0]);
		}, $text);
		echo $text;
	}
}
?>
