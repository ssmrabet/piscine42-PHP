<?php
function ft_is_sort($array){
	$asort = $array;
	sort($asort);
	if (array_diff_assoc($asort, $array) == null)
		return true;
	return false;
}
?>
