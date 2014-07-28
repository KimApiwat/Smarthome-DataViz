@extends('layouts.master')
@section('content')
	<script type="text/javascript" src="{{URL::asset('lib/js/radialgraph.js')}}"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="http://code.highcharts.com/highcharts-more.js"></script>
	<script src="http://code.highcharts.com/modules/data.js"></script>
	<script src="http://code.highcharts.com/modules/exporting.js"></script>

	<div class="page-header">
		<h1> {{strtoupper($activity)}} <small> {{$start_day}} until {{$end_day}} </small><h1>
	</div>
	<div id="container" style="min-width: 420px; max-width: 1000px; height: 1000px; margin: 0 auto"></div>

<div style="display:none">
		<!-- Source: http://or.water.usgs.gov/cgi-bin/grapher/graph_windrose.pl -->
		<table id="freq" border="0" cellspacing="0" cellpadding="0">
			<tr nowrap bgcolor="#CCCCFF">
				<th colspan="10" class="hdr">Table of Frequencies (percent)</th>
			</tr>
			<tr nowrap bgcolor="#CCCCFF">
				<th class="freq">Location</th>
				@foreach($location_array as $location)
					<th class="freq">{{$location}}</th>
				@endforeach
			</tr>
			@for($i=0; $i<count($dataset_array); $i++)
				@if(($i+1)%2 ==0 )	<tr nowrap bgcolor="#DDDDDD">
				@else <tr nowrap>
				@endif
				<td class="dir">{{$i}}</td>
				@foreach($location_array as $location)
					<td class="data">{{$dataset_array[$i][$location]}}</td>
				@endforeach	
			</tr>
			@endfor		
		</table>
	</div>
@stop 
