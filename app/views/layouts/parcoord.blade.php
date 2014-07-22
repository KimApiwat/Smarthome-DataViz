@extends('layouts.master')
@section('sidebar')
	@parent
	<p> This is appended to the master sidebar. </p>
@stop
@section('content')
	<div class="page-header">
		<h1>Visualization</h1>
	</div>
	
	<div class="container">
		<div id="graph" class="parcoords" style="width:1200px;height:400px"></div>
	{{ Form::open(array('action'=>'DataManagementController@createGraphVisualization'))}}

        <input id="choose_activity" type="checkbox" name="choose_activity" value="choose_activity" />
		{{Form::label('choose_activity','choose activity')}}
        {{Form::select('act1',array_combine($array_activity,$array_activity),'default',array('id'=>'act1','disabled'=>'disabled'))}}
		{{Form::select('act2',array_combine($array_activity,$array_activity),'default',array('id'=>'act2','disabled'=>'disabled'))}}
        {{Form::select('act3',array_combine($array_activity,$array_activity),'default',array('id'=>'act3','disabled'=>'disabled'))}}
        {{Form::select('act4',array_combine($array_activity,$array_activity),'default',array('id'=>'act4','disabled'=>'disabled'))}}
        {{Form::select('act5',array_combine($array_activity,$array_activity),'default',array('id'=>'act5','disabled'=>'disabled'))}}
       	<input id="choose_specific_day" type="checkbox" name="choose_specific_day" value="choose_specific_day"/>
		{{Form::label('choose_specific_day','choose specific day')}}
		{{Form::select('first_day',array_combine($array_day,$array_day),'default',array('id'=>'first_day','disabled'=>'disabled'))}}
		{{Form::label('to','to')}} 
        {{Form::select('second_day',array_combine($array_day,$array_day),'default',array('id'=>'second_day','disabled'=>'disabled'))}}
		{{Form::submit('update',array('name'=>'submit'))}}
		{{Form::submit('default',array('name'=>'submit'))}}
	{{ Form::close() }}
		<div class="container" style="height:200px; overflow:scroll">
			<div id="grid"></div>
		</div>
	<script language="javascript" id="brushing"> var data =  <?php echo $json_default_data ?>; </script>
	<script language="javascript" src="{{URL::asset('lib/js/draw.parcoords.graph.js')}}"></script>
	@stop
