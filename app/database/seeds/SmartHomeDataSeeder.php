<?php 
class SmartHomeDataSeeder extends BaseSeeder {
	public function __construct()
	{
		// Your database table name
		$this->table = 'smarthome';
		// Filename and location of data in csv file.	
		$this->filename = public_path().'/dataset/dataset.csv'; 
	}
}
?>
