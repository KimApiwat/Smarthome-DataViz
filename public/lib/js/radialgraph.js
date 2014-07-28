// this function For Clock Visualization
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
	        text: 'Clock Visualization',
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


