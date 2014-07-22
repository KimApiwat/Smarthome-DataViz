        var i = 0;
        var arr_obj = [];
        var url;
        var dimension = [];
        jQuery(document).ready(function(){
            $("#generate_HeatMap").click(function(e){
                console.log(arr_obj);
                /* set color range */
                var colorLow = 'green' , colorMed = 'yellow' , colorHigh = 'red' ; 
                var colorScale = d3.scale.linear()
                    .domain([0, 100, 200])
                    .range([colorLow, colorMed, colorHigh]);
                var svgContainer = d3.selectAll("#viz").append("svg")
                                            .attr("width", '100%' )
                                            .attr("height", '100%')

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
                        tooltip.html( "Activity : "+ d["activity"]+"</br>Location : "+ d["location"] + "</br>Time(s) : " +d["amount"]+"</br>Position : ("+d["x"]+","+d["y"]+")" )
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
                var x = e.pageX - this.offsetLeft;
                var y = e.pageY - this.offsetTop; 

                /* var c=document.getElementById("special"); */
                var context= this.getContext("2d"); /*c.getContext("2d");*/
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
                    $('#status2').html(x +', '+ y);
                    if(i+1<number_point) {                    
                        $('#current').html("Locate Location for .... </br> Activity : " + data[i+1]["activity"] + "</br>Location : " + data[i+1]["location"]);
                    }
                    i++;
                }else {
                    alert('Your point is not enough');
                    $("#generate_HeatMap").prop("disabled",false);
                }
                context.stroke();
                console.log(arr_obj);
            });
            $('#imageLoader').change(function(e){
                $('#current').html("Locate Location for .... </br> Activity : " + data[0]["activity"] + "</br>Location : " + data[0]["location"]);
                var file = e.target.files[0],
                    imageType =/image.*/;
                if(!file.type.match(imageType)) return;
                var reader = new FileReader();
                var canvas = $('#special')[0];
                var context = canvas.getContext('2d');
                url = URL.createObjectURL(e.target.files[0]);
                var img;
                reader.onload = function(event) {
                    img = new Image();
                    img.onload = function() {
                        canvas.width = img.width;
                        canvas.height = img.height;
                        context.drawImage(img,0,0);

                        var width = img.width;
                        var height = img.height;
                        dimension.push({
                            "width" : width,
                            "height" : height,
                            "url" : url
                        });
                    }
                    img.src = event.target.result;
                };
                reader.readAsDataURL(file);
                seatsArrayY = [];
                seatsArrayX = [];
                i = 0; 
            });
            /* clear input */
            document.getElementById("imageLoader").value = "";
        });