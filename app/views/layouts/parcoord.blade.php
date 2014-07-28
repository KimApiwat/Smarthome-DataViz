@extends('layouts.master')
@section('sidebar')
	@parent
	<p> This is appended to the master sidebar. </p>
@stop
@section('content')
	<style>
		/* data table styles */
		#grid { height: 198px; }
		.row, .header { clear: left; font-size: 12px; line-height: 18px; height: 18px; }
		.row:nth-child(odd) { background: rgba(0,0,0,0.05); }
		.header { font-weight: bold; }
		.cell { float: left; overflow: hidden; white-space: nowrap; width: 110px; height: 18px; }
		.col-0 { width: 110px; }
	</style>	
	<div class="page-header">
		<h1>Visualization</h1>
	</div>
	<div><ul class="pager"><li class="previous"><a href="#">&larr; Back</a></li></ul></div>	
	<div class="panel panel-default"><div class="panel-body">
		<div id="graph" class="parcoords" style="width:100%;height:500px"></div>
		<div class="container" style="width:100%;height:200px; overflow:scroll">
			<div id="grid"></div>
		</div>
	</div></div>

	<script language="javascript" id="brushing"> var data =  <?php echo $json_default_data ?>; </script>
	<script language="javascript" src="{{URL::asset('lib/js/draw.parcoords.graph.js')}}"></script>
	@stop
