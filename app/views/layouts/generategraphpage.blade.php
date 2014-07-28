@extends('layouts.master')
@section('content')

	<script type="text/javascript" src="{{URL::asset('lib/js/gen.graph.button.js')}}"></script>
	
	<h1>Generate Graph page !!!!</h1>
	<div><ul class="pager"><li class="previous"><a href="#">&larr; Home</a></li></ul></div>
	<form action="create" method="post" role="form" class="form-horizontal">
		<div class="form-group">
			<div class="radio">
				<label>
					{{Form::radio('type','Parcoordinate',null,array('id'=>'graphI',))}}
					Parcoordinate
				</label>
			</div>
			<div class="row">
				<div class="col-md-11 col-md-offset-1">
					<div class="radio">
						<label>
							{{Form::radio('graphI','default',null,array('id'=>'graphI_default','disabled'=>'disabled'))}}
							Default graph
						</label>
						<label>
					</div>
					<div class="radio">
						<label>
							{{Form::radio('graphI','specific',null,array('id'=>'graphI_specific','disabled'=>'disabled'))}}
							Specific graph
						</label>
					</div>
					<div class="col-md-11 col-md-offset-1">
						<label> Please choose acitivity </label>
						<div class="checkbox">
    						<label>
    							<input id="graphI_checkbox_activity1" name="graphI_checkbox" type="checkbox" disabled="disabled"/>  
    							Activity 1 : 
    							{{Form::select('graphI_act',array_combine($array_activity,$array_activity),'default',array('id'=>'graphI_act1','disabled'=>'disabled'))}}
    						</label> 
    					</div>
    					<div class="checkbox">
    						<label> 
    							<input id="graphI_checkbox_activity2" name="graphI_checkbox" type="checkbox" disabled="disabled"/>
    							Activity 2 : 
    							{{Form::select('graphI_act',array_combine($array_activity,$array_activity),'default',array('id'=>'graphI_act2','disabled'=>'disabled'))}}
    						</label> 
    					</div>
    					<div class="checkbox">
    						<label> 
    							<input id="graphI_checkbox_activity3" name="graphI_checkbox" type="checkbox" disabled="disabled"/>
    							Activity 3 : 
    							{{Form::select('graphI_act',array_combine($array_activity,$array_activity),'default',array('id'=>'graphI_act3','disabled'=>'disabled'))}}
    						</label> 
    					</div>
    					<div class="checkbox">
    						<label> 
    							<input id="graphI_checkbox_activity4" name="graphI_checkbox" type="checkbox" disabled="disabled"/> 
    							Activity 4 : 
    							{{Form::select('graphI_act',array_combine($array_activity,$array_activity),'default',array('id'=>'graphI_act4','disabled'=>'disabled'))}}
    						</label> 
    					</div>
    					<div class="checkbox">
    						<label> 
    							<input id="graphI_checkbox_activity5" name="graphI_checkbox" type="checkbox" disabled="disabled"/>
    							Acitivity 5 : 
    							{{Form::select('graphI_act',array_combine($array_activity,$array_activity),'default',array('id'=>'graphI_act5','disabled'=>'disabled'))}}
							</label> 
						</div>
					</div>
					<div class="col-md-11 col-md-offset-1">
						<label>
							Please Choose day :
							{{Form::select('graphI_first_day',array_combine($array_day,$array_day),'default',array('id'=>'first_day','disabled'=>'disabled'))}}
							to
							{{Form::select('graphI_second_day',array_combine($array_day,$array_day),'default',array('id'=>'second_day','disabled'=>'disabled'))}}
						</label>
					</div>
				{{Form::submit('Generate Graph I',array('name'=>'submit','id'=>'submit_graph1',"class"=>"btn btn-success btn-sm")) }}
				</div>
			</div>
		</div>
		<hr>
		<div class="form-group">
			<div class="radio">
				<label>
					{{Form::radio('type','Clock',false,array('id'=>'graphII'))}}
					Radial
				</label>
			</div>
			<div class="row">
				<div class="col-md-11 col-md-offset-1">
					<label>
						Please Choose activity :
						{{Form::select('graphII_activity',array_combine($array_activity,$array_activity),'default',array('id'=>'act1','disabled'=>'disabled'))}}
					</label>
				</div>
				<div class="col-md-11 col-md-offset-1">
					<label>
						Please Choose day :
						{{Form::select('graphII_first_day',array_combine($array_day,$array_day),'default',array('id'=>'first_day','disabled'=>'disabled'))}}
						to
						{{Form::select('graphII_second_day',array_combine($array_day,$array_day),'default',array('id'=>'second_day','disabled'=>'disabled'))}}
					</label>
				</div>
				<div class="col-md-11 col-md-offset-1">
					{{Form::submit('Generate Graph II',array('name'=>'submit','id'=>'submit_graph2',"class"=>"btn btn-success btn-sm"))}}
				</div>
			</div>
		</div>	
		<hr>
		
		<div class="form-group">
			<div class="radio">
				<label>
					{{Form::radio('type','Heatmap',false,array('id'=>'graphIII',))}}
					Heatmap
				</label>
			</div>
			<div class="row">
				<div class="col-md-11 col-md-offset-1">
				{{Form::submit('Generate Graph III',array('name'=>'submit','id'=>'submit_graph3',"class"=>"btn btn-success btn-sm"))}}
				</div>
			<div>
		</div>
	</form>
@stop 
