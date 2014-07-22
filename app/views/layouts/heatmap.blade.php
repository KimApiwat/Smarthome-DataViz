@extends('layouts.master')
@section('content')
   <style type="text/css">
      #canvas{background-color:yellow;}
      .tooltip {
            position: absolute;
            width: 150px;
            height: 80px;
            pointer-events: none;
        }
    </style>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script language="javascript" src="{{URL::asset('lib/js/heatmap.js')}}"></script>

    <script type="text/javascript">
    var data = <?php echo $json_data ?>;
    var number_point = data.length;
    </script>
	<input type="file" id="imageLoader" name="imageLoader"/>
    <label id="current"></label>
    <h2 id="status2">0, 0</h2>
    <canvas disabled="true" style="border:1px ridge green;" id="special"></canvas>
    <div>
        <button type="button" id="generate_HeatMap" disabled="disabled" class="btn btn-default">Generate Graph</button>
    </div>
    <div>
        <g id="viz"></g>
    </div>
@stop