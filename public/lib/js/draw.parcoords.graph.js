	var graph;
	var colorgen = d3.scale.category20();
	var colors = {};
	
	_(data).chain() 
		.pluck('day') 
		.uniq() 
		.each(function(d,i) { colors[d] = colorgen(i); }); 
	var color = function(d) { return colors[d.day]; }; 
	graph  = d3.parcoords()("#graph") 
		.data(data) 
		.color(color) 
		.alpha(0.4) 
		.margin({top:25, left:15, bottom:15, right:0 }) 
		.mode("queue") 
		.rate(1)
		.render()
		.brushable() 
		.interactive();
	//create data table,row hover highlighting
	var grid = d3.divgrid();
	d3.select("#grid")
		.datum(data)
		.call(grid)
		.selectAll(".row")
		.on({
			"mouseover": function(d) { graph.highlight([d])},
			"mouseout": graph.unhighlight 
		});
	//update data table on brush event
	graph.on("brush",function(d)	{
		d3.select("#grid")
			.datum(d)
			.call(grid)
			.selectAll(".row")
			.on({
				"mouseover": function(d) { graph.highlight([d]) },
				"mouseout": graph.unhighlight
			});
	});

