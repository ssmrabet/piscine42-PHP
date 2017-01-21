<?PHP
class Fighter
{
	private $name;

	public function __construct($fct)
	{
		$this->name = $fct;
	}

	public function getName()
	{
		return ($this->name);
	}
}
?>
