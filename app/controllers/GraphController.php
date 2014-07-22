<?php
class GraphController extends BaseController {
	protected function showTestMaster()	{
		return View::make('layouts.testmaster');
	}
	protected function createParcoordinateVisualization()	{
		echo "<pre>";
		print_r(Input::All());
		echo "</pre>";
		$input = Input::get('option');
		if($input['graphI'] == 'default')	{
			$data_handle = new DataHandle();
			$array_raw_data = $data_handle->getRawDataFromDB();
			$array_day = $data_handle->getAllDay();
			$array_activity = $data_handle->getAllActivity();
			$array_default_data = $data_handle->getDefaultDataArrayForParcoordinate($array_raw_data,$array_day,$array_activity);
			
			$json_default_data = json_encode($array_default_data);			
			return View::make('layouts.parcoord')
				->with('json_default_data',$json_default_data)
				->with('array_day',$array_day)
				->with('array_activity',$array_activity);
		}else if($input['graph'] == 'specific')	{
		}else { }
	}

	protected function createClockVisualization()	{
		$input = Input::get('option');	
		//var_dump($input);
		if ($input['type'] == 'Clock') {
			$day_first = $input['graphII_first_day'];
			$day_second = $input['graphII_second_day'];
			$activity = $input['graphII_activity'];
			//echo $activity;	
			$dataset = DB::table('smarthome')
				->distinct()
				->select('day','time','condition','location')
				->where('activity',$activity)
				->whereBetween('day',array($day_first,$day_second))
				->get();
			//echo "before dataset analyse";
			$data_handle = new DataHandle();
			$location_array = $data_handle->getLocation($dataset);
			//var_dump($location_array);
			$dataset_array = $data_handle->getDataForCircleGraph($dataset);
		}else{	}
		return View::make('layouts.radialgraph')
			->with('start_day',$day_first)
			->with('end_day',$day_second)
			->with('activity',$activity)
			->with('dataset_array',$dataset_array)
			->with('location_array',$location_array);
	}

	protected function createHeatmapVisualization()	{
		$array_data = DB::table('smarthome')
				->select('activity','location',DB::raw('count(*)'))
				->groupBy('activity','location')
				->get();
		$json_data = json_encode($array_data);
		return View::make('layouts.heatmap')
			->with('json_data',$json_data);
	}
}
?>