jQuery(document).ready(function(){
	var i = 0;
	var arr_obj_data = [];
	var dimension = [];
	var indexId = 1;
	var circleId = 0;

	var arr_Image = [];
	/* clear input when refresh */
	document.getElementById("imageLoader").value = "";
	$("#undo_button").prop("disabled",true);

	var cPushArray = new Array();
	var cStep = -1;
	$('#imageLoader').change(function(e){
		$("#myCanvas").show();
		$(".current_activity").html(data[0]["activity"]);
		$(".current_location").html(data[0]["location"]);
		$('.status').html("( 0 , 0 )");
		var file = e.target.files[0],imageType =/image.*/;
		if(!file.type.match(imageType)) return;
		var reader = new FileReader();
		var canvas = $('#myCanvas')[0];
		var context = canvas.getContext('2d');
		var url = URL.createObjectURL(e.target.files[0]);
		var img;
		reader.onload = function(event) {
			img = new Image();
			img.src = event.target.result;
			img.onload = function() {
				if(img.width > 800 || img.height > 800 ) {
					alert("Error : Image is large");
					return;
				}else {
					canvas.height = img.height;
					canvas.width = img.width;
					context.drawImage(img,0,0);
					cPush();
					var width = img.width;
					var height = img.height;
					dimension.push({
						"width" : width,
						"height" : height,
						"url" : url
					});
				}
			}
		};
		reader.readAsDataURL(file);
		arr_obj_data = [];
		i = 0; 

	});
	$("#undo_button").click(function(e) {
		$("#generate_HeatMap").prop("disabled",true);
		// removes the last element of an array and return that element.
		arr_obj_data.pop();
		console.log(arr_obj_data);
		i--;
		$(".current_activity").html(data[i]["activity"]);
		$(".current_location").html(data[i]["location"]);
		$('#datatable tr:last-child').remove();
		if(i == 0) $(this).prop("disabled",true);
		indexId--;
		circleId--;
		cUndo();


	});
	$("#myCanvas").click(function(e){ 
		$("#undo_button").prop("disabled",false);
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop; 

		/* var c=document.getElementById("myCanvas"); */
		var context= this.getContext("2d"); 
		context.beginPath();
		//limited number of circle.
		if(i<number_point)   {
			cPush();
			context.arc(x, y, 10,0, 2*Math.PI);
			context.fillStyle = "green";
			context.fill();
			context.lineWidth = 3;
			context.strokeStyle = '#003300';
			circleId++;
			arr_obj_data.push({
				"id" : circleId,
				"x" : x,
				"y" : y,
				"activity" : data[i]["activity"],
				"location" : data[i]["location"],
				"amount" : data[i]["count(*)"]
			});
			$('.status').html("( "+ x + " , " + y + " )");
			if(i+1<number_point) {                    
				$(".current_activity").html(data[i+1]["activity"]);
				$(".current_location").html(data[i+1]["location"]);
			}else{
				$(".current_activity").html("Null");
				$(".current_location").html("Null");

			}

			$('#datatable > tbody:last').append('<tr> <td>'+data[i]["id"]+'</td> <td>'+data[i]["activity"]+'</td> <td>'+data[i]["location"]+'</td> <td>'+'( '+x+','+y+' )'+ '</td><td><span class="label label-success">Saved</span></td> </tr>');
			indexId++;
			i++;
			console.log(arr_obj_data);
		}else {
			alert('Your point is not enough');
			$("#generate_HeatMap").prop("disabled",false);
		}
		context.stroke();
		//console.log(arr_obj_data);
	});
	$
	$("#generate_HeatMap").click(function(e){
		$(this).prop("disabled",true);
		$("#undo_button").prop("disabled",true);
		$("#table").hide();
		$("#showimage").hide(10,function()	{
			$("#heatmapViz").show("fast");
		});
		//console.log(arr_obj_data);
		/* set color range */
		var colorLow = 'green' , colorMed = 'yellow' , colorHigh = 'red' ; 
		var colorScale = d3.scale.linear()
				.domain([0, 100, 200])
				.range([colorLow, colorMed, colorHigh]);
		var svgContainer = d3.selectAll("#viz").append("svg")
				.attr("width", dimension[0]["width"] )
				.attr("height", dimension[0]["height"])
		var tooltip = d3.select("body").append("div")
				.attr("class", "tooltip")
				.style("opacity", 0);
		/* set background image to svg container */
		var imgs = svgContainer.selectAll("image").data([0]);
		imgs.enter()
				.append("svg:image")
				.attr("xlink:href", dimension[0]["url"])
				.attr("x", "0")
				.attr("y", "0")
				.attr("width", dimension[0]["width"])
				.attr("height", dimension[0]["height"]);
		/* draw circle depend on dataset */
		var elemEnter = svgContainer.selectAll("g")
				.data(arr_obj_data)
				.enter().append("g")
				.attr("transform",function(d){return "translate("+d.x+","+d.y+")"})
		var circle = elemEnter.append("circle")
				.attr("r",20)
				.style("stroke","black")
				.style("fill",function(d){return colorScale(d.amount);})
				.style("opacity","0.5")
				.on('mouseover',function(d){
					d3.select(this).style( {opacity:'1'});
					tooltip.transition()
							.duration(200)
							.style("opacity", .9);
					tooltip.html( "Activity : "+ d["activity"]+"</br>Location : "+ d["location"] + "</br>Frequency : " +d["amount"]+"</br>Position : ("+d["x"]+","+d["y"]+")" )
							.style("left", (d3.event.pageX + 20) + "px")
							.style("top", (d3.event.pageY - 30) + "px")
							.style("background-color","#000000")
							.style("color","#FFFFFF");
				})
				.on('mouseout',function(d){
					d3.select(this).style( {opacity:'0.5'} );
					tooltip.transition()
							.duration(500)
							.style("opacity", 0);

				})
	});
	function cPush() {
	    cStep++;
	    if (cStep < cPushArray.length) { cPushArray.length = cStep; }
	    cPushArray.push(document.getElementById("myCanvas").toDataURL());
    
	}
	function cUndo() {
	    if (cStep > 0) {
	        var canvasPic = new Image();
	        canvasPic.src = cPushArray[cStep];
	        canvasPic.onload = function () { document.getElementById("myCanvas").getContext("2d").drawImage(canvasPic, 0, 0); }
	        cStep--;
	    }
	}
});
