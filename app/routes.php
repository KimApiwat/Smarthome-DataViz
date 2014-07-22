<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::any('/',
	[
		'as'=>'/',
		'uses' => 'HomeController@showWelcome'
	]
);
Route::get('homepage',
	[
		'as'=>'homepage',
		'uses'=>'ViewController@showHomepage'
	]
);
Route::any('readfile',
	[
		'uses'=>'DataManagementController@readCSVfile',
		'as'=>'readfile'
	]
);

Route::any('graph',
	[
		'uses'=>'ViewController@showGenerateGraphPage',
		'as'=>'graph'
	]
);

Route::any('visualization/graph',
	[
		'as'=>'visualization',
		'uses'=>'DataManagementController@createGraphVisualization'
	]
);
Route::post('create',function()	{
	echo "<pre>";
	print_r(Input::All());
	echo "</pre>";
	if(Input::get('submit') == 'Generate Graph II') {
		return Redirect::action('GraphController@createClockVisualization',
			array(
				'option'=>Input::All()
			));
	}else if(Input::get('submit') == 'Generate Graph I')	{
		return Redirect::action('GraphController@createParcoordinateVisualization',
			array(
				'option'=>Input::All()
			));
	}else if(Input::get('submit') =='Generate Graph III'){ 
		return Redirect::action('GraphController@createHeatmapVisualization');
	}else{ } 
});


Route::any('create/graph1',
	[
		'as'=>'create/graph1',
		'uses'=>'GraphController@createParcoordinateVisualization'
	]
);
Route::any('create/graph2',
	[
		'as'=>'create/graph2',
		'uses'=>'GraphController@createClockVisualization'
	]
);
Route::any('create/graph3',
	[
		'as'=>'create/graph3',
		'uses'=>'GraphController@createHeatmapVisualization'
	]
);

Route::post('/testajax',function(){
	if(Request::ajax())	{
		return Response::json(Input::all());
	}
});

Route::get('/upload', 'ImageController@getUploadForm');
Route::post('/upload/image','ImageController@postUpload');
