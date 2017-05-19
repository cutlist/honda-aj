<!DOCTYPE html>
<html class="bg-white">
    <head>
        <meta charset="UTF-8">
        <title>SIHONDA | Log in</title>
        <link rel="shortcut icon" href="favicon.ico"> 
        <link href="page/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="page/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        
    </head>
    
    <body class="bg-white">
        <div class="col-xs-2"></div>
        <a href="h1/" id="h1"></a>
        <a href="h2h3/" id="h2"></a>
        <div class="col-xs-4" id="h1" onclick="location.href='h1/'">
	        <div class="form-box" id="login-box" style="cursor:pointer">
	            <div class="header">
	            	<img src="gambar/logo-white.png" style="width:180px"></br>
	            	<h3 style="padding:20px">LOGIN H1</h3>
	            	<img src="gambar/h1.png" style="height:80px"></br></br>
	            </div>
	        </div>
		</div>
        <div class="col-xs-4" onclick="location.href='h2h3/'">
	        <div class="form-box" id="login-box" style="cursor:pointer">
	            <div class="header">
	            	<img src="gambar/logo-white.png" style="width:180px"></br>
	            	<h3 style="padding:20px">LOGIN H2 H3</h3>
	            	<img src="gambar/h2h3.png" style="height:80px"></br></br>
	            </div>
	        </div>
		</div>
        <div class="col-xs-2"></div>
        
        <div style="background-color:#fa1515;width:100%;height:40px;position:absolute;bottom:15px;">
        	<div style="width:80px;height:80px;border-radius:80px;background:#fa1515;margin-top:-40px;margin-left:10%;float: left;">
        		<img src="gambar/logo-footer.png" style="height:80px;margin-top:0px;margin-left:0px">
			</div>
        </div>     
        
        <!-- mousetrap -->
        <script src="page/js/mousetrap.js" type="text/javascript"></script> 
		<script>
		function GoToLocation(url){
		    window.location = url;
		  	}

		  	Mousetrap.bind("1", function() {
		    GoToLocation(document.getElementById("h1").href);
		  	});
		  	Mousetrap.bind("2", function() {
		    GoToLocation(document.getElementById("h2").href);
		  	});
		</script>

    </body>
</html>