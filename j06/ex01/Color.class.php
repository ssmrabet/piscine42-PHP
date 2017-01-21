<?php
class Color
{
	public $red;
	public $green;
	public $blue;
	static $verbose = False;

	public function __construct($array)
	{
		if (isset($array['red']) && isset($array['green']) && isset($array['blue']))
		{
			$this->blue = intval($array['blue']);
			$this->green = intval($array['green']);
			$this->red = intval($array['red']);
		}
		else if(isset($array['rgb']))
		{
			$rgb = intval($array['rgb']);
			$this->blue = $rgb % 256;
			$this->green = $rgb / 256 % 256;
			$this->red = $rgb / 256 / 256 % 256;
		}
		if (Self::$verbose)
			printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n", $this->red, $this->green, $this->blue);
	}

	function __destruct()
	{
		if (Self::$verbose)
			printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n", $this->red, $this->green, $this->blue);
	}

	function __toString()
	{
		return (vsprintf("Color( red: %3d, green: %3d, blue: %3d )", array($this->red, $this->green, $this->blue)));
	}

	public static function doc()
	{
		echo "\n";
		$ret = fopen("Color.doc.txt", 'r');	
		while ($ret && !feof($ret))
			echo fgets($ret);
	}

	public function add($color)
	{
		$tab = array('red'=>$this->red + $color->red, 'green'=>$this->green + $color->green, 'blue'=>$this->blue + $color->blue);
		$instance = new Color($tab);
		return ($instance);
	}

	public function sub($color)
	{
		$tab = array('red'=>$this->red - $color->red, 'green'=>$this->green - $color->green, 'blue'=>$this->blue - $color->blue);
		$instance = new Color($tab);
		return ($instance);
	}

	public function mult($x)
	{
		$tab = array('red'=>$this->red * $x, 'green'=>$this->green * $x, 'blue'=>$this->blue * $x);
		$instance = new Color($tab);
		return ($instance);
	}
}
?>
