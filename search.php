<?php
	session_start();
	if(!isset($_SESSION['user'])) {
		$_SESSION['user'] = 'shahi2';
	}
	include_once('./db_conn.php');
	$conn = connect_to_db();

	$q_year = "SELECT DISTINCT year FROM posts";
	$filter_year = mysqli_query($conn,$q_year);
	$q_city = "SELECT DISTINCT city FROM posts";
	$filter_city = mysqli_query($conn,$q_city);
	$q_state = "SELECT DISTINCT state FROM posts";
	$filter_state = mysqli_query($conn,$q_state);
	$q_price_max = "SELECT MAX(price) FROM posts";
	$filter_price_max = mysqli_query($conn,$q_price_max);
	$q_price_min = "SELECT MIN(price) FROM posts";
	$filter_price_min = mysqli_query($conn,$q_price_min);
	$q_miles_max = "SELECT MAX(miles) FROM posts";
	$filter_miles_max = mysqli_query($conn,$q_miles_max);
	$q_miles_min = "SELECT MIN(miles) FROM posts";
	$filter_miles_min = mysqli_query($conn,$q_miles_min);
	$q_model = "SELECT DISTINCT model FROM posts";
	$filter_model = mysqli_query($conn,$q_model);

if(!empty($_GET['post_id'])) {
	$post_id = $_GET['post_id'];
	$query_find = 'SELECT * FROM posts WHERE post_id = '.$post_id;
	$result_find = mysqli_query($conn,$query_find);
	$row_find = mysqli_fetch_assoc($result_find);
	
/*
	$forpostid = "SELECT * FROM posts WHERE post_id = '".$post_id."'";
        $q_forOrigin = mysqli_query($conn,$forpostid);
	foreach($q_forOrigin as $row){
		$dest_city = $row['city'];
		$dest_state = $rpw['state'];
		$dest = str_replace(' ','+',$row['city']).",".$row['state'];
	}
	//echo $dest_city;
	$q_stateandcity = "SELECT DISTINCT City, State FROM posts WHERE city != '".$dest_city."'";
	$filter_stateandcity = mysqli_query($conn,$q_stateandcity);
	$str_all = '';
	$i = 0;
	$str_all_arr = array();
	foreach($filter_stateandcity as $row)
	{
		if($i%100 == 99) {
			$str_all = substr($str_all,0,-1);
			array_push($str_all_arr,$str_all);
			$str_all = '';
		}
		$str_all .= str_replace(' ', '+',$row['City']).",".$row['State'].'|';
		$i++;
	}
	$str_all = substr($str_all,0,-1);
	//str_all contains the origin and destinations formatted for the request URL to the
	//google Distance matrix api

	array_push($str_all_arr,$str_all);
	//here we parse each block of data we get from each request

	foreach($str_all_arr as $str_all) {
		$str_api = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.$dest.'&destinations='.$str_all.'&key=AIzaSyCHoJ5zWQ0TDTa7N75WhP2R1vQW84Tshd0';
		$data = file_get_contents($str_api);
		$parsed = json_decode($data,true);

		//echo var_dump($parsed);
		$distance = array();
		if(isset($total_addresses)) {
			$total_addresses = array_merge($total_addresses,$parsed['destination_addresses']);
			foreach($parsed['rows'] as $row) {
				foreach($row['elements'] as $element) {
					array_push($distance,(float)str_replace(",","",explode(" ",$element['distance']['text'])[0]));
				}
			}
			$total_distance = array_merge($total_distance,$distance);
		} else {
			$total_addresses = $parsed['destination_addresses'];
			foreach($parsed['rows'] as $row) {
				foreach($row['elements'] as $element) {
					array_push($distance,(float)str_replace(",","",explode(" ",$element['distance']['text'])[0]));
				}
			}
			$total_distance = $distance;
		}
	}
	//collect the 10 minimum citiy destinations by parsing and removing from total addresses
	$min_array_of_cities = array();
	$curr_min_array = array();
	$curr_min_index = 0;
	$curr_address = array();
	for($i=0;$i<25;$i++){
		$curr_min_array = array_keys($total_distance, min(array_filter($total_distance)));
		$curr_min_index = $curr_min_array[0];
		$curr_address = explode(",",$total_addresses[$curr_min_index]);
		array_push($min_array_of_cities,$curr_address[0]);
		unset($total_distance[$curr_min_index]);
		unset($total_addresses[$curr_min_index]);
	}
	#echo var_dump($min_array_of_cities);
	$prices = array();
	//calculate the avg price for each city
	foreach($min_array_of_cities as $city){
		$query = "SELECT AVG(price) FROM posts WHERE city = '".$city."'";
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_assoc($result);
		array_push($prices,$row["AVG(price)"]);
	}
	//echo var_dump($prices);
	//echo var_dump($min_array_of_cities);
	$dataPoints = array();
	for($i=0;$i<25;$i++) {
		array_push($dataPoints,array("y" => (float)$prices[$i], "label" => $min_array_of_cities[$i]));
	}
*/
	//echo var_dump($dataPoints);
	$dataPoints2 = array();
	$query = "SELECT make,COUNT(make) FROM posts WHERE city = '".$row_find['city']."' GROUP BY make";
	$result = mysqli_query($conn,$query);
	foreach($result as $row) {
		array_push($dataPoints2,array("y" => (float)$row['COUNT(make)'], "label" => $row['make']));
	}

	$dataPoints3 = array();
	$query = "SELECT state,AVG(price) FROM posts WHERE make = '".$row_find['make']."' GROUP BY state ORDER BY state";
	$result = mysqli_query($conn,$query);
	foreach($result as $row) {
		array_push($dataPoints3,array("y" => (float)$row['AVG(price)'], "label" => $row['state']));
	}
	/*$dataPoints = array(
		array("y" => 3373.64, "label" => "Germany" ),
		array("y" => 2435.94, "label" => "France" ),
		array("y" => 1842.55, "label" => "China" ),
		array("y" => 1828.55, "label" => "Russia" ),
		array("y" => 1039.99, "label" => "Switzerland" ),
		array("y" => 765.215, "label" => "Japan" ),
		array("y" => 612.453, "label" => "Netherlands" )
	);
	*/
}
?>

<html>
<head>


        <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous"></script>
	<!-- Bootstrap CDNs -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
	  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
	  crossorigin="anonymous"></script>
	<link	rel="stylesheet"
	  href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
	  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
	  crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
	  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
	  crossorigin="anonymous"></script>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script>
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer2", {
		animationEnabled: true,
		theme: "light2",
		title:{
			text: "Average Price of Make by State"
		},
		axisY: {
			title: "Average Price"
		},
		data: [{
			type: "column",
			yValueFormatString: "$#,##0.##",
			dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
		}]
	});
	chart.render();
	var chart2 = new CanvasJS.Chart("chartContainer", {
		animationEnabled: true,
		theme: "light2",
		title:{
			text: "Distribution of Makes in this City"
		},
		axisY: {
			title: "Number of Sales"
		},
		data: [{
			type: "column",
			yValueFormatString: "#,##0",
			dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
		}]
	});
	chart2.render();
}
</script>

</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="#">Craigslist++</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item">
	  <a class="nav-link" href="./index.php">Home</a>
	      </li>
	      <li class="nav-item active">
	  <a class="nav-link" href="./search.php">Search<span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	  <a class="nav-link" href="./manage.php">Manage</a>
	      </li>
	      <li class="nav-item">
	  <a class="nav-link" href="./inbox.php">Inbox</a>
	      </li>
	    </ul>
	    <span class="navbar-text">
		Welcome, <select onchange=change_user() id="user">
			<option value="shahi2" <?php if($_SESSION['user'] == 'shahi2') echo 'selected';?>>Teesh</option>
			<option value="srkrish2" <?php if($_SESSION['user'] == 'srkrish2') echo 'selected';?>>Sneha</option>
			<option value="skchuen2" <?php if($_SESSION['user'] == 'skchuen2') echo 'selected';?>>Sam</option>
		</select>!
	    </span>
	  </div>
	</nav>
	<div class="container-fluid">
	<div class="row">
		<div class="col-3" style="background-color:#13294b; height: 94.5%">
			<br>
			<table id="inbox_list" class="table table-hover table-bordered">
				<tr class='table-light'>
					<td>
						<button type="button" class="btn btn-light" onclick="openclose('makes')">Make</button><br><br>
						<div id='makes' class="w3-container w3-hide pre-scrollable">
							<?php
								$query = "SELECT DISTINCT make FROM posts";
								$result = mysqli_query($conn,$query);
								foreach($result as $row) {
									echo '<div class="form-check">
										<input class="make-class" type="checkbox" value="'.$row['make'].'" id="defaultCheck1">
										<label class="form-check-label" for="defaultCheck1">'
											.$row['make'].
										'</label>
									</div>';
								}
							?>
						</div>
					</td>
				</tr>
				<tr class="table-light">
					<td>
						<button type="button" class="btn btn-light" onclick="openclose('models')">Model</button><br><br>
						<div id='models' class="w3-container w3-hide pre-scrollable">
							<?php
								foreach($filter_model as $row) {
									echo '<div class="form-check">
									<input class="model-class" type="checkbox" value="'.$row['model'].'" id="defaultCheck1">
									<label class="form-check-label" for="defaultCheck1">'
									.$row['model'].
									'</label>
									</div>';
								}
							?>
						</div>
					</td>
				</tr>
				<tr class="table-light">
					<td>
						<button type="button" class="btn btn-light" onclick="openclose('cities')">City, State</button><br><br>
						<div id='cities' class="w3-container w3-hide pre-scrollable">
							<?php
								foreach($filter_city as $row) {
									echo '<div class="form-check">
									<input class="city-class" type="checkbox" value="'.$row['city'].'" id="defaultCheck1">
									<label class="form-check-label" for="defaultCheck1">'
									.$row['city'].
									'</label>
									</div>';
								}
							?>
						</div>
					</td>
				</tr>
				<tr class="table-light">
					<td>
						<button type="button" class="btn btn-light" onclick="openclose('years')">Year</button><br><br>
						<div id='years' class="w3-container w3-hide pre-scrollable">
								<div class="form-inline">
									<input type='text' id="yearmin" placeholder='Min (eg 1999)'>
									<input type='text' id="yearmax" placeholder='Max(eg 2015)'>
								</div>
						</div>
					</td>
				</tr>
				<tr class="table-light">
					<td>
						<button type="button" class="btn btn-light" onclick="openclose('price_range')">Price</button><br><br>
						<div id='price_range' class="w3-container w3-hide pre-scrollable">
							<div class="form-inline">
								<input type='text' id="pricemin" placeholder='Min (eg 10000)'>
								<input type='text' id="pricemax" placeholder='Max(eg 20000)'>
							</div>
						</div>
					</td>
				</tr>
			</table>
			<button type='submit'  onclick=filtersearch() class='btn btn-primary'>Search</button>
		</div>

		<div class="col-9" style="overflow:hidden">
			<br>
			<div class="row">
				<div class="col-12" style="height:7%">
					<form onsubmit="return text_search()">  
						<div class="form-row">
							<div class="col">
								<input id='text_for_search' class="form-control mr-sm-2"  placeholder="Search">
				  			</div>
							<div class="col">
								<button type="submit" class="btn btn-success">Search</button>
							</div>
					</form>
				</div>
				<hr>
			</div>
			<div id='post_search_result' class="col-12" style="height:85.2%;overflow-y:scroll">
			<h1 id="post_id">Post #<?php echo $post_id?></h1>
			<div class="row" style="height:50%">
			<?php
				if($post_id) {
					echo '<table class="table table-bordered table-dark" style="width:50%">
						<tr><th>Make</th><td>'.$row_find['make'].'</td></tr>
						<tr><th>Model</th><td>'.$row_find['model'].'</td></tr>
						<tr><th>Year</th><td>'.$row_find['year'].'</td></tr>
						<tr><th>Mileage</th><td>'.$row_find['mileage'].'</td></tr>
						<tr><th>City</th><td>'.$row_find['city'].', '.$row_find['state'].'</td></tr>
						<tr><th>Price</th><td>$'.$row_find['price'].'</td></tr>
						<tr><th>Owner</th><td>'.$row_find['owner'].'</td></tr>
						<tr><td colspan=2><button onclick=message_user("'.$row_find['owner'].'") type="button" class="btn btn-success">Message</button></td></tr>
					</table>';
				}

			?>
			<div id="chartContainer" style="height: 320px; width: 50%;"></div>
			</div>
			<div class="row" style="height:50%">
			<div id="chartContainer2" style="height: 300px; width: 100%;"></div>
			</div>
			</div>
		</div>
</body>
<script>
function redir(post_id) {
	window.location = "./search.php?post_id="+post_id;
}

function message_user(user) {
	var post_id = $('#post_id').text().split('#')[1]
	var sender = $('#user').val();
	$.post("message_user_begin.php",
	{
		post_id:post_id,
		sender:sender,
		receiver:user
	},
	function(data) {
		alert(data);
	});
}

function openclose(id) {
    var x = document.getElementById(id);
	$('.w3-show').addClass('w3-hide').removeClass('w3-show');
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

function text_search(){
	var text = $('#text_for_search').val();
	if ($.isNumeric(text)) {
		$.post("get_post.php",{
			post_id:text
		},
		function(data){
			$('#post_search_result').html(data);
		}
		);
	}
	else {
		$.post("full_search.php", {
			text: text
		},
		function(data){
			$('#post_search_result').html(data);
		});
	}
	return false;
}

function filtersearch(){
	var price_max = $('#pricemax').val()
	var price_min = $('#pricemin').val()
	var year_min = $('#yearmin').val()
	var year_max = $('#yearmax').val()
	var makes = [];
	var city = [];
	var models = [];
	$.each($(".make-class:checkbox:checked"), function(){
                makes.push($(this).val());
            });
	$.each($(".model-class:checkbox:checked"), function(){
                models.push($(this).val());
            });
	$.each($(".city-class:checkbox:checked"), function(){
                city.push($(this).val());
            });
	$.post("filter_search.php", {
		price_min: price_min,
		price_max: price_max,
		year_min: year_min,
		year_max: year_max,
		makes: makes,
		city: city,
		models: models
	},
	function(data){
		$('#post_search_result').html(data);
	});
}
</script>
<style>
#inbox_list {
	border-spacing: 15px;
}
#inbox_list td {
	padding: 20px;
}
.carousel-inner > .carousel-item > img {
    margin: auto;
}
</style>
</html>
