@extends('layouts.master')
@section('content')
   <style type="text/css">
      #canvas{background-color:yellow;}
      .tooltip {
            position: absolute;
            width: 300px;
            height: 300px;
            pointer-events: none;
        }
    </style>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script language="javascript" src="{{URL::asset('lib/js/heatmap.js')}}"></script>

    <script type="text/javascript">
		var data = <?php echo $json_data ?>;
		var number_point = data.length;
    </script>
	<div class="page-header">
		<h1> Heat map Visualization </h1>
	</div>
	<div><ul class="pager"><li class="previous"><a href="#">&larr; Back</a></li></ul></div>
	<!-- Start : panel and panel-body -->
	<div class="panel panel-default"><div class="panel-body">
		<!-- -->
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
			<input type="file" class="filestyle" data-buttonBefore="true" id="imageLoader" name="imageLoader" style="display:inline-block;"/>
			</div>
			<div class="col-md-4"></div>
		</div>

		<div id="showimage" style="text-align:center;margin-top:20px;">
			<canvas style="display:none;border:1px ridge green;" id="myCanvas"></canvas>
		</div>
		<div id="heatmapViz" style="display:none;text-align:center;margin-top:20px;">
			<g id="viz"></g>
		</div>
		<div style="text-align:center;margin-top:20px">
			<button type="button" id="undo_button" class="btn btn-default" style="margin-right:10px">Undo</button>
			<button type="button" id="generate_HeatMap" disabled="disabled" class="btn btn-default">Generate Graph</button>
		</div>
		<div class="row" style="text-align:center;">
			<div class="col-sm-6">
				<div><h4><span class="label label-info">Set Point</span></h4></div>
				<div class="table-responsive" >
					<table class="table table-bordered">
						<tr>
							<th style="text-align:center">Activity</th>
							<th style="text-align:center">Location</th>
						</tr>
						<tr>
							<td><span class="current_activity">null</span></td>
							<td><span class="current_location">null</span></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-sm-6">
				<div><h4><span class="label label-info">Set Position</span></h4></div>
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<th style="text-align:center">Position</th>
						</tr>
						<tr>
							<td><span class="status">( x , y )</span></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<!-- -->	
		<div id="table" class="col-sm-12" style="text-align:center">
			<div><h3><span class="label label-info">status</span></h3></div>
			<div class="table-responsive"> 
				<table id="datatable" class="table table-bordered" style="text-align:center;">
					<tr>
						<th style="text-align:center">ID</th>
						<th style="text-align:center">Activity</th>
						<th style="text-align:center">Location</th>
						<th style="text-align:center">Position</th>
						<th style="text-align:center">Status</th>
					</tr>
				</table>
			</div>
		</div>
	</div></div> <!-- End : panel and panel-body -->
@stop
