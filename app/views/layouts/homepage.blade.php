@extends('layouts.master')
@section('content')
	<script language="javascript">
		/*
		var x = data;
		var svg1 = d3.select("body")
			.append("p").attr("class","information")
			.append("p").attr("class","name")
			.selectAll("p")
			.data(x)
			.enter()
			.append("p").attr("id",function(d,i) { return d.id } )
			.text(function(d,i) { return d.name } );
		
		var svg2 = d3.select("body")
			.select("p").attr("class","information")
			.append("p").attr("class","economy")
			.selectAll("p")
			.data(x)
			.enter()
			.append("p").attr("id",function(d,i) { return d.id } )
			.text(function(d,i) { return d.economy });
		 */
	</script>
		<div class="banner">
			<div class="jumbotron">
				<h1>Data Visualization !!!</h1>
				<p>This is web application for visualize data from smart home dataset.</p>
				<p><a href="#" class="btn btn-primary btn-lg" role="button">Learn more »</a></p>
			</div>
		</div>
		{{Form::open(array('action'=>'DataManagementController@readCSVfile','files'=>true ,"class"=>"form-horizontal","role"=>"form"))}}
			{{Form::label('file','Please choose file')}}
			{{Form::file('file')}}
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
