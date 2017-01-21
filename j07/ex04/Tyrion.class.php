<?php
class Tyrion
{
	public function sleepWith($x)
	{
		if ($x instanceof Jaime || $x instanceof Cersei)
			print("Not even if I'm drunk !" . PHP_EOL);
		else if ($x instanceof Sansa)
			print("Let's do this." . PHP_EOL);
	}
}
?>
