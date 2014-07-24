var i = 0;
var arr_obj = [];
var dimension = [];
var index = 1;

/* Variable for undo */
var cPushArray = new Array();
var cStep = 0;

jQuery(document).ready(function(){
	$("#undo").click(function(e) {
		$("#generate_HeatMap").prop("disabled",true);
		// removes the last element of an array and return that element.
		arr_obj.pop();
		i--;
		$(".current_activity").html(data[i]["activity"]);
		$(".current_location").html(data[i]["location"]);
		$('#datatable tr:last-child').remove();
		if(i == 0) $(this).prop("disabled",true);
		index--;
	});
	$("#generate_HeatMap").click(function(e){
		$(this).prop("disabled",true);
		$("#undo").prop("disabled",true);
		$("#table").hide();
		$("#showimage").hide(10,function()	{
			$("#heatmapViz").show("fast");
		});
		//console.log(arr_obj);
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
				.data(arr_obj)
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
	$("#special").click(function(e){ 
		$("#undo").prop("disabled",false);
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop; 

		/* var c=document.getElementById("special"); */
		var context= this.getContext("2d"); 
		context.beginPath();
		//limited number of circle.
		if(i<number_point)   {
			context.arc(x, y, 10,0, 2*Math.PI);
			context.fillStyle = "green";
			context.fill();
			context.lineWidth = 3;
			context.strokeStyle = '#003300';
			arr_obj.push({
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
			}
			
			$('#datatable > tbody:last').append('<tr> <td>'+index+'</td> <td>'+data[i]["activity"]+'</td> <td>'+data[i]["location"]+'</td> <td>'+'( '+x+','+y+' )'+ '</td><td><span class="label label-success">Saved</span></td> </tr>');
			index++;
			i++;
		}else {
			alert('Your point is not enough');
			$("#generate_HeatMap").prop("disabled",false);
		}
		context.stroke();
		//console.log(arr_obj);
	});
	$('#imageLoader').change(function(e){
		$("#special").show();
		$(".current_activity").html(data[0]["activity"]);
		$(".current_location").html(data[0]["location"]);
		$('.status').html("( 0 , 0 )");
		var file = e.target.files[0],imageType =/image.*/;
		if(!file.type.match(imageType)) return;
		var reader = new FileReader();
		var canvas = $('#special')[0];
		var context = canvas.getContext('2d');
		var url = URL.createObjectURL(e.target.files[0]);
		var img;
		reader.onload = function(event) {
		img = new Image();
		img.onload = function() {
			if(img.width > 800 || img.height > 800 ) {
				alert("Error : Image is large");
				return;
			}else {
				canvas.height = img.height;
				canvas.width = img.width;
				context.drawImage(img,0,0);
				var width = img.width;
				var height = img.height;
				dimension.push({
					"width" : width,
					"height" : height,
					"url" : url
				});
			}
		}
		img.src = event.target.result;
		};
		reader.readAsDataURL(file);
		arr_obj = [];
		i = 0; 

	});
	/* clear input */
	document.getElementById("imageLoader").value = "";
	$("#undo").prop("disabled",true);
});
