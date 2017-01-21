<?php
class Vertex
{
	private $_x;
	private $_y;
	private $_z;
	private $_w = 1.0;
	private $_color;
	static $verbose = False;

	public function __construct($array)
	{
		$this->_x = $array['x'];
		$this->_y = $array['y'];
		$this->_z = $array['z'];
		if (isset($array['w']) && !empty($array['w']))
			$this->_w = $array['w'];
		if (isset($array['color']) && !empty($array['color']) && $array['color'] instanceof Color)
			$this->_color = $array['color'];
		else
			$this->_color = new Color(array('red'=>255, 'green'=>255, 'blue'=>255));
		if (Self::$verbose)
			printf("Vertex( x: %0.2f, y: %0.2f, z: %0.2f, w: %0.2f, Color( red: %3d, green: %3d, blue: %3d ) ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
	}

	function __destruct()
	{
		if (Self:: $verbose)
			printf("Vertex( x: %0.2f, y: %0.2f, z: %0.2f, w: %0.2f, Color( red: %3d, green: %3d, blue: %3d ) ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
	}

	function __toString()
	{
		if (Self::$verbose)
		{
			$tab = array('x'=>$this->_x, 'y'=>$this->_y, 'z'=>$this->_z, 'w'=>$this->_w, 'red'=>$this->_color->red, 'green'=>$this->_color->green, 'blue'=>$this->_color->blue);
			return(vsprintf("Vertex( x: %0.2f, y: %0.2f, z: %0.2f, w: %0.2f, Color( red: %3d, green: %3d, blue: %3d ) )", $tab));
		}
		return (vsprintf("Vertex( x: %0.2f, y: %0.2f, z: %0.2f, w: %0.2f )", array($this->_x, $this->_y, $this->_z, $this->_w)));
	}

	public static function doc()
	{
		$ret = fopen("Vertex.doc.txt", 'r');
		echo "\n";
		while ($ret && !feof($ret))
			echo fgets($ret);
	}

	public function getX(){return $this->_x;}
	public function setX($x){$this->_x = $x;}
	public function getY(){return $this->_y;}
	public function setY($y){$this->_y = $y;}
	public function getZ(){return $this->_z;}
	public function setZ($z){$this->_z = $z;}
	public function getW(){return $this->_w;}
	public function setW($w){$this->_w = $w;}
	public function getColor(){return $this->_color;}
	public function setColor($color){$this->_color = $color;}
}
?>
