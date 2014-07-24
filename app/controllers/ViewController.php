<?php
class ViewController extends BaseController	{
	public function showGenerateGraphPage()	{
		$array_day = Session::get('array_day');
		$array_activity = Session::get('array_activity');
		return View::make('layouts.generategraphpage',compact('array_day','array_activity'));
	}
	public function showHomepage()	{
		return View::make('layouts.homepage');
	}	
	public function showHeatmapPage()	{
		return View::make('layouts.heatmap');
	}
	public function showParcoordinateVisualization()	{
	}
	public function showClockVisualization()	{
	}
}
?>
