$(document).ready(function() {
	$("#graphI").click(function() {
		if($(this).is(":checked")) {
			$('input[name=graphI]').prop("disabled",false);
			$('select[name=graphII_activity]').prop("disabled",true);
			$('select[name=graphII_first_day]').prop("disabled",true);
			$('select[name=graphII_second_day]').prop("disabled",true);

			$("#submit_graph1").attr("disabled",false);
			$("#submit_graph2").attr("disabled",true);
			$("#submit_graph3").attr("disabled",true);
		}
	})

	$("#graphI_default").click(function() {
		if($(this).is(":checked")) {
			$("input[name=graphI_checkbox]").prop("disabled",true);
			$("input[name=graphI_checkbox]").prop("checked",false);
			$("select[name=graphI_act]").prop("disabled",true);
			$("select[name=graphI_first_day]").prop("disabled",true);
			$("select[name=graphI_second_day]").prop("disabled",true);
		}
	});

	$("#graphI_checkbox_activity1").click(function() {
		if($(this).is(":checked")) {
			$("#graphI_act1").prop("disabled",false);
		}else{
			$("#graphI_act1").prop("disabled",true);
		}
	});
	$("#graphI_checkbox_activity2").click(function() {
		if($(this).is(":checked")) {
			$("#graphI_act2").prop("disabled",false);
		}else{
			$("#graphI_act2").prop("disabled",true);
		}
	});
	$("#graphI_checkbox_activity3").click(function() {
		if($(this).is(":checked")) {
			$("#graphI_act3").prop("disabled",false);
		}else{
			$("#graphI_act3").prop("disabled",true);
		}
	});
	$("#graphI_checkbox_activity4").click(function() {
		if($(this).is(":checked")) {
			$("#graphI_act4").prop("disabled",false);
		}else{
			$("#graphI_act4").prop("disabled",true);
		}
	});
	$("#graphI_checkbox_activity5").click(function() {
		if($(this).is(":checked")) {
			$("#graphI_act5").prop("disabled",false);
		}else{
			$("#graphI_act5").prop("disabled",true);
		}
	});
	$("#graphI_specific").click(function() {
		if($(this).is(":checked")) {
			$("input[name=graphI_checkbox]").prop("disabled",false);
			$("select[name=graphI_first_day]").prop("disabled",false);
			$("select[name=graphI_second_day]").prop("disabled",false);

		}
	});
	$("#graphII").click(function() {
		if($(this).is(":checked")) {
			$('select[name=graphII_activity]').prop("disabled",false);
			$('select[name=graphII_first_day]').prop("disabled",false);
			$('select[name=graphII_second_day]').prop("disabled",false);
			
			$('input[name=graphI]').prop('disabled',true);
			$('input[name=graphI]').prop("checked",false);
			$("input[name=graphI_checkbox]").prop("checked",false);
			$("input[name=graphI_checkbox]").prop("disabled",true);

			$("select[name=graphI_act]").prop("disabled",true);
			$("select[name=graphI_first_day]").prop("disabled",true);
			$("select[name=graphI_second_day]").prop("disabled",true);

			$("#submit_graph1").attr("disabled",true);
			$("#submit_graph2").attr("disabled",false);
			$("#submit_graph3").attr("disabled",true);
		}
	});


	$("#graphIII").click(function() {
		if($(this).is(":checked")) {
			$('select[name=graphII_activity]').prop("disabled",true);
			$('select[name=graphII_first_day]').prop("disabled",true);
			$('select[name=graphII_second_day]').prop("disabled",true);

			$('input[name=graphI]').prop('disabled',true);
			$('input[name=graphI]').prop("checked",false);
			$("input[name=graphI_checkbox]").prop("checked",false);
			$("input[name=graphI_checkbox]").prop("disabled",true);
			$("select[name=graphI_act]").prop("disabled",true);
			$("select[name=graphI_first_day]").prop("disabled",true);
			$("select[name=graphI_second_day]").prop("disabled",true);

			$("#submit_graph1").attr("disabled",true);
			$("#submit_graph2").attr("disabled",true);
			$("#submit_graph3").attr("disabled",false);
		}
	});
});

$(function () {
  
    // Parse the data from an inline table using the Highcharts Data plugin
    $('#container').highcharts({
    	data: {
	    	table: 'freq',
	    	startRow: 1,
	    	endRow: 25,
	    	endColumn: 12
	    },
	    
	    chart: {
	        polar: true,
	        type: 'column'
	    },
	    
	    title: {
	        text: 'Visualization'
	    }, 
	    pane: {
	    	size: '85%'
	    },
	    
	    legend: {
	    	reversed: true,
	    	align: 'right',
	    	verticalAlign: 'top',
	    	y: 100,
	    	layout: 'vertical'
	    },
	    
	    xAxis: {
	    	tickmarkPlacement: 'on'
	    },
	        
	    yAxis: {
	        min: 0,
	        endOnTick: false,
	        showLastLabel: true,
	        title: {
	        	text: 'time(minutes)'
	        },
	        labels: {
	        	formatter: function () {
	        		return this.value + ' minute(s)';
	        	}
	        }
	    },
	    
	    tooltip: {
	    	valueSuffix: ' minute(s)'
	    },
	        
	    plotOptions: {
	        series: {
	        	stacking: 'normal',
	        	shadow: false,
	        	groupPadding: 0,
	        	pointPlacement: 'on'
	        }
	    }
	});
});


