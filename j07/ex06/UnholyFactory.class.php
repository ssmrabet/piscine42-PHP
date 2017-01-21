<?php
class UnholyFactory
{
	private $array=array();

	public function absorb($type)
	{
		if (!(get_parent_class($type)))
			print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
		else
		{
			if (array_key_exists($type->getName(), $this->array))
				print("(Factory already absorbed a fighter of type " . $type->getName() . ")" . PHP_EOL);
			else
			{
				print("(Factory absorbed a fighter of type " . $type->getName() . ")" . PHP_EOL);
				$this->array[$type->getName()] = $type;
			}
		}
	}

	public function fabricate($rf)
	{
		if (array_key_exists($rf, $this->array))
		{
			print("(Factory fabricate a fighter of type " . $rf . ")" . PHP_EOL);
			return ($this->array[$rf]);
		}
		else
			print("(Factory hasn't absorbed any fighter of type " . $rf . ")" . PHP_EOL);
	}
}
?>
