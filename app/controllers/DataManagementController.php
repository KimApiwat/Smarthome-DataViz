<?php
class DataManagementController extends BaseController	{
	/**
	 *	+-------------------------------------------------------------------------------------------+
	 *	|  Read data from CSV file format then save data into Database ( localhost ).               |
	 *	+-------------------------------------------------------------------------------------------+
	 */
	public function readCSVfile()
	{
		$input = Input::all();
		$rules = array(
			'file'=>'required|mimes:csv,txt'
		);
		$validator = Validator::make($input,$rules);
		if($validator->passes())	
		{
			//--- initial table ---
			DB::delete('delete from smarthome');
			
			$file = Input::file('file');
			$filename = $file->getClientOriginalName();
			$destinationPath = public_path().'/dataset/';
			$uploadSuccess = $file->move($destinationPath,$filename);
			$filepath = $destinationPath.$filename;

			$data_handle = new DataHandle();	
			//------------------ read csv file and change it into array -------------
			$array_raw_data = $data_handle->getRawDataFromPaht($filepath);
			
			//----- save array_raw_data into database table 'smarthome' ----- 
			DB::table('smarthome')->truncate();
			DB::table('smarthome')->insert($array_raw_data);

			$array_day = $data_handle->getAllDay();
			$array_activity = $data_handle->getAllActivity();
			
			
			//var_dump(array_combine($array_day,$array_day));	
			return Redirect::route('graph')
				->with('array_day',$array_day)
				->with('array_activity',$array_activity);
		}else{
			return Redirect::route('homepage');
		}
	} 
}
