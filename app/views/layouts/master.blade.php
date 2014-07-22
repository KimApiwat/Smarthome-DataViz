<!DOCTYPE html>
<html> 
	<head> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
		<!-- script -->
		<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"> </script> 
		<script type="text/javascript" src="{{URL::asset('lib/js/d3.parcoords.js')}}"> </script>
		<script type="text/javascript" src="{{URL::asset('lib/js/underscore.js')}}"> </script>
		<script type="text/javascript" src="{{URL::asset('lib/js/underscore.math.js')}}"> </script>
		<script type="text/javascript" src="{{URL::asset('lib/js/divgrid.js')}}"> </script>
    	<script type="text/javascript" src="{{URL::asset('lib/js/jQuery/jquery-2.1.1.js')}}"> </script>
		<script type="text/javascript" src="{{URL::asset('lib/js/radialBarChart.js')}}"> </script>
		<!-- stylesheet -->
		<link rel="stylesheet" type="text/css" href="{{URL::asset('lib/css/d3.parcoords.css')}}"></link>
		<link rel="stylesheet" type="text/css" href="{{URL::asset('lib/bootstrap/css/bootstrap.css')}}"></link>
		<link rel="stylesheet" type="text/css" href="{{URL::asset('lib/bootstrap/css/bootstrap-theme.css')}}"></link>
		<link rel="stylesheet" type="text/css" href="{{URL::asset('lib/css/style.css')}}"></link>
		<!-- custom js -->
		<script type="text/javascript" src="{{URL::asset('lib/js/custom.js')}}"></script>
		<!-- custom css -->
		<link rel="stylesheet" type="text/css" href="{{URL::asset('lib/css/custom.css')}}"></link>
		<style>
			/* data table styles */
			#grid { height: 198px; }
			.row, .header { clear: left; font-size: 12px; line-height: 18px; height: 18px; }
			.row:nth-child(odd) { background: rgba(0,0,0,0.05); }
			.header { font-weight: bold; }
			.cell { float: left; overflow: hidden; white-space: nowrap; width: 120px; height: 18px; }
			.col-0 { width: 180px; }
		</style>
	</head>
	<body role="document">
		<header>
			<!--Fixed navbar -->
			<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="/">Smart home</a>
					</div>
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
							<li><a href="/homepage">Home</a></li>
							<li><a href="#about">About</a></li>
							<li><a href="#contact">Contact</a></li>
						</ul>
					</div>
				<!--/.nav-collapse -->
				</div>
			</nav>
		</header>
		<div class="container" role="main" width="100%" height="100%">
			@yield('content')
			<footer>
				<hr>
				<p> Developed by Xk studio 2014</p>
			</footer>
		</div>
	</body>
</html>
