<?php
class DataHandle	{
	/**
	 * Read data from CSV file.
	 * Return : Data that read from CSV file.
	 */
	public function getRawDataFromPaht($filepath)	{
		$array_raw_data = $fields = array();
		$i=0;
		$handle = @fopen($filepath, "r");
		if ($handle) 
		{
			while (($row = fgetcsv($handle, 4096)) !== false) 
			{
				if (empty($fields)) 
				{
					$fields = $row;
					continue;
				}
				foreach ($row as $k=>$value) 
				{
					$value = (str_replace(' ','_',$value));
					$array_raw_data[$i][$fields[$k]] = $value;
				}
				$i++;
			}
			if (!feof($handle)) {
				echo "Error: unexpected fgets( fail )\n";
			}
			fclose($handle);
		}
		
		return $array_raw_data;
	}
	/**
	 * Get All Data from Database.
	 */
	public function getRawDataFromDB()	{
		return  DB::table('smarthome')->select('day','time','activity','condition')->get();
	}
	/**
	 * Get All Date from Database.
	 */
	public function getAllDay()	{
		$days = DB::table('smarthome')->distinct()->select('day')->get();
		$array_days = array();
		foreach($days as $day)	{ 
			$array_days[] = $day->day;
		}
		return $array_days;
	}
	/**
	 * Get All Activity from Database.
	 */
	public function getAllActivity()	{
		$activities = DB::table('smarthome')->distinct()->select('activity')->get();
		$array_activities =array();
		foreach($activities as $activity)	{ 
			$array_activities[] = $activity->activity; 
		}
		return $array_activities;
	}
	/**
	 * Get sensor location from dataset.
	 */
	public function getLocation($dataset)	{
		$array_location = array();
		foreach($dataset as $data)	{
			if(!in_array($data->location, $array_location))	{
				array_push($array_location, $data->location);
			}
		}
		return $array_location;
	}
	/**
	 * Create Data format for create Parcoordinate Graph Visualization.
	 */
	public function getDefaultDataArrayForParcoordinate($array_raw_data,$array_day,$array_activity)	{
		//-------------------- Create Multidimension array ----------------------
		$multiple_array = array();
		for($i=0; $i<count($array_day); $i++)	
		{
			$temp_arr = array("day"=>$array_day[$i]);
			for($j=0; $j<count($array_activity); $j++)	
			{
				$temp_arr = array_merge($temp_arr,array($array_activity[$j]=>0));
			}
			array_push($multiple_array,$temp_arr);
		}
		/*
		 * -------------------- Print array for checking data --------------------
		 * combine key(array_day) => value (multiple_array)
		 */
		$array_default_data = array_combine($array_day,$multiple_array);
		for( $i=0; $i<count($array_raw_data)-1; $i++)
		{
			if($array_raw_data[$i]->activity == $array_raw_data[$i+1]->activity)	
			{
				if($array_raw_data[$i]->condition == 'start' && $array_raw_data[$i+1]->condition == 'end')
				{
					$time_start = strtotime($array_raw_data[$i]->day.' '.$array_raw_data[$i]->time);
					$time_end = strtotime($array_raw_data[$i+1]->day.' '.$array_raw_data[$i+1]->time);
					$diff = $time_end - $time_start;
					$index_day = $array_raw_data[$i]->day;
					$index_act = $array_raw_data[$i]->activity;
					$array_default_data[$index_day][$index_act] += $diff;
					$i++;	 
				}
			}
		}
		return array_values($array_default_data);
	}
	/**
	 * Create Data format for craete Clock Graph Visualization.
	 */
	public function getDataForCircleGraph($dataset)	{
		
		$array = array_fill(0,24,0);
		//var_dump($location_array);
		//var_dump($array);
		//$array = array_combine($key,$value);
		$key = array(
			"0","1","2","3",
			"4","5","6","7",
			"8","9","10","11",
			"12","13","14","15",
			"16","17","18","19",
			"20","21","22","23"
		);
		$multiple_array = array();
		$location_array = $this->getLocation($dataset);	
		for($i=0; $i<count($key); $i++)	
		{
			$temp_arr =array();
			for($j=0; $j<count($location_array); $j++)	
			{
				$temp_arr = array_merge($temp_arr,array($location_array[$j]=>0));
			}
			array_push($multiple_array,$temp_arr);
		}
		for($i = 0; $i<count($dataset)-1; $i++)	{
			if($dataset[$i]->condition == "start" && $dataset[$i+1]->condition == "end")	
			{
				$date_start = new DateTime($dataset[$i]->day.' '.$dataset[$i]->time);
				$date_end = new DateTime($dataset[$i+1]->day.' '.$dataset[$i+1]->time);
				$interval = $date_start->diff($date_end);
				$time_start = strtotime($dataset[$i]->day.' '.$dataset[$i]->time);
				$time_end = strtotime($dataset[$i+1]->day.' '.$dataset[$i+1]->time);
				$day_diff = (int)$interval->format('%a');
				$location = $dataset[$i]->location;
				if( $day_diff!=0 )	{
					for($j=0; $j<=$day_diff; $j++)	{
						for($k=0; $k<24; $k++)	{
							//$array[$k] += 60;
							$multiple_array[$k][$location] += 60;
						}
					}
					//$array = $this->calculateTime($array,$time_start,$time_end,$location);
					$multiple_array = $this->calculateTime($multiple_array,$time_start,$time_end,$location);
				}
				else	{
					// Case : $day_diff == 0 
					//$array = $this->calculateTime($array,$time_start,$time_end,$location);
					$multiple_array = $this->calculateTime($multiple_array,$time_start,$time_end,$location);
				}
				$i++;
			} 
		}
		//var_dump($multiple_array);
		//var_dump($array);
		//$new_array = array_combine($key,$multiple_array);
		/*
		$key2 = array('data');
		$temp_arr = array();
		array_push($temp_arr,$new_array);
		$temp_arr = array_combine($key2,$temp_arr);
		*/
		//return $temp_arr;
		//var_dump($multiple_array);
		return $multiple_array;
	}

	
	public function calculateTime($multiple_array,$time_start,$time_end,$location)	{
		$hour_start = (int)date('G',$time_start);
		$min_start = (int)date('i',$time_start);
		$hour_end = (int)date('G',$time_end);
		$min_end = (int) date('i',$time_end);
		if($hour_start < $hour_end)	{
			for($j = $hour_start+1; $j<=$hour_end-1; $j++)	{
				//$array[$j] += 60;
				$multiple_array[$j][$location] += 60;
			}
			//$array[$hour_start] += 60-$min_start;
			//$array[$hour_end]  += $min_end;
			$multiple_array[$hour_start][$location] += 60-$min_start;
			$multiple_array[$hour_end][$location]  += $min_end;
		}else if($hour_start > $hour_end){
			/*
			 * example : 2009-10-11 8:10:00 ---> 2009-10-12 7:10:00
			 */
			for($a=$hour_start+1; $a<24; $a++)		{
					//$array[$a] +=60;
					$multiple_array[$a][$location] += 60;
			}
			for($a = 0; $a<=$hour_end-1; $a++)	{
				//$array[$a] += 60;
				$multiple_array[$a][$location] +=60;
			}
			//$array[$hour_start] += 60-$min_start;
			//$array[$hour_end] += $min_end;
			$multiple_array[$hour_start][$location] += 60-$min_start;
			$multiple_array[$hour_end][$location]  += $min_end;
		}else {
			/*	
			 * example : 2009-10-11 8:10:00 ---> 2009-10-11 8:20:00
			 */
			//$array[$hour_start] += $min_end-$min_start;
			$multiple_array[$hour_start][$location] += $min_end-$min_start;
		}
		//return $array;
		return $multiple_array;
	}
}
?>
