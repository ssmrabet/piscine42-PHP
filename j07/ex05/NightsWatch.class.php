<?php
class NightsWatch implements IFighter
{

	private $array;

	public function recruit($person)
	{
		if ($person instanceof IFighter)
			$this->array[] = $person;
	}

	function fight()
	{
		foreach ($this->array as $person)
			$person->fight();
	}
}
?>
