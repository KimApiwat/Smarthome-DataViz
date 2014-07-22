<?php
class DataStorage {
	private $raw_data;
	private static $instance;
	////Have a single globally accessible static method
	private function __construct() { } 
	private function __clone() { }
	private function __wakeup() { }
	public static function getInstance()	{
		if(!isset(self::$instance))	{
			$class = __CLASS__;
			self::$instance = new $class();
			echo '<script type="text/javascript">console.log("create Instance");</script>'; 
		}
		return self::$instance;
	}
	public function saveRawData($raw_data)	{
		echo '<script type="text/javascript">console.log("save _data");</script>'; 
		$this->raw_data = $raw_data;
	}
	public function getRawData()	{
		return $this->raw_data;
	}

}
