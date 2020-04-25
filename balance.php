<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3367D6">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="icon/apple-icon-180x180.png" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="manifest" href="manifest.webmanifest">
	<title>Budget</title>
		<?
			require "connectDB.req.php";
	
			$sql = 'SELECT DATE_FORMAT(transactionDate,"%Y-%m") label,ROUND(SUM(transactionAmount),0) y FROM transactions GROUP BY DATE_FORMAT(transactionDate,"%Y-%m")';
			$grp = $pdo -> query($sql);
	
			$dataPoints = array();
			echo "<br><br><br><br>";

			$bal = 0;
			while ($row = $grp -> fetch()) 
			{
				//echo "label: ".$row['label']." y: ".$categ['y'];
				$bal = $bal + $row['y'];
        		array_push($dataPoints, array("label"=> $row['label'], "y"=> $bal));
    		}
	?>
	<script>
		window.onload = function () 
		{
 
			var chart = new CanvasJS.Chart("chartContainer", 
			{
				animationEnabled: true,
				theme: "light2", // "light1", "light2", "dark1", "dark2"
				title: 
				{
					text: "Total balance"
				},
				axisY: 
				{
					title: "Amount",
					includeZero: true
				},
				data: [{
					type: "spline",
					dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
				}]
			});
			chart.render();
		}
	</script>
</head>
<body>
	<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
		<a class="navbar-brand" href="#">
	  		BUDGET
		</a>
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>
	  	<div class="collapse navbar-collapse" id="navbarNavDropdown">
	    	<ul class="navbar-nav">
	      		<li class="nav-item dropdown">
	        		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          			Actions
	        		</a>
	        		<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
	        			<a class="dropdown-item" href="index.php">New</a>
	        			<a class="dropdown-item" href="balance.php">Balance</a>
	        		</div>
	      		</li>
	    	</ul>
	  	</div>
	</nav>	
	<div class="container">
		<div class="row">
			<div class="col">
				&nbsp;
			</div>
		</div>			
		<div class="row">
			<div class="col">
				&nbsp;
			</div>
		</div>			
		<div class="row">
			<div class="col">
				&nbsp;
			</div>
		</div>
		<div class="row">
			<div class="col align-self-end" style="text-align:right;">
				Balance 
			</div>
		</div>
		<hr width=100%>
		<div class="card">
			<div class="card-body">
				<div class=row>
					&nbsp;
				</div>
				<div class="card">
					<div class="card-body">
						<h6 class="card-title">Balance</h6>
						<div class=row>
							<div class="col-md-12">
								Balance:
								<?
									require "connectDB.req.php";

									$sql = "SELECT SUM(transactionAmount) ta FROM transactions;";
									$totam = $pdo -> query($sql);

									while ($tot = $totam -> fetch()) 
									{
										$fmt = new NumberFormatter( 'de_DE', NumberFormatter::CURRENCY );
										echo $fmt->formatCurrency($tot['ta'], "EUR");
									}
								?>
							</div>
						</div>
						<div class=row>
							<div class="col-md-12">
								Graph:
							</div>
							<div id="chartContainer" style="height: 370px; width: 100%;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script src="sw.js"></script>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
</body>
</html>
