@extends('layouts.master')
@section('content')
		<div class="banner">
			<div class="jumbotron">
				<h1>Data Visualization !!!</h1>
				<p>This is web application for visualize data from smart home dataset.</p>
				<p><a href="#" class="btn btn-primary btn-lg" role="button">Learn more »</a></p>
			</div>
		</div>
		{{Form::open(array('action'=>'DataManagementController@readCSVfile','files'=>true ,"class"=>"form-horizontal","role"=>"form"))}}
			{{Form::label('file','Please choose file')}}
			<div class="input-group input-group-lg">
				<input name="file" type="file" class="filestyle" data-buttonBefore="true">
			</div>
			{{Form::submit('upload',["class"=>"btn btn-primary","style"=>"margin-top: 15px; margin-bottom: 15px;"])}}
			{{Form::reset('Reset',["class"=>"btn btn-danger","style"=>"margin-top: 15px; margin-bottom: 15px;"])}}
		{{Form::close()}}
		<!--
		<form action="#">
			<label for="">name</label>
			<input type="text" name="name">
			<button type="submit">Submit </button>
		</form>
		-->
@stop
