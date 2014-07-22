<?php
class Graph extends Eloquent	{
	private $name="Apiwat Srisirisittikul";
	public function getName()	{
		return $this->name;
	}
	public function setName($name)	{
		$this->name = $name;
	}
}
?>
