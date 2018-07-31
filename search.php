<?php
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
	}

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
	/*str_all contains the origin and destinations formatted for the request URL to the
	google Distance matrix api*/

	array_push($str_all_arr,$str_all);
	//here we parse each block of data we get from each request

	foreach($str_all_arr as $str_all) {
		$str_api = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.$dest.'&destinations='.$str_all.'&key=AIzaSyA_w7Njzw4kXFRwXuYrsJTcZYiIP0q4Djg';
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
	for($i=0;$i<10;$i++){
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
	//echo var_dump($min_array_addresses);
	$dataPoints = array();
	for($i=0;$i<10;$i++) {
		array_push($dataPoints,array("y" => (float)$prices[$i], "label" => $min_array_of_cities[$i]));
	}
	echo var_dump($dataPoints);

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
<script>
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
		animationEnabled: true,
		theme: "light2",
		title:{
			text: "Prices in Nearby cities"
		},
		axisY: {
			title: "Average Price in City"
		},
		data: [{
			type: "column",
			yValueFormatString: "$#,##0.##",
			dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
		}]
	});
	chart.render();
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
		welcome, <select onchange=change_user() id="user">
			<option value="shahi2">Teesh</option>
			<option value="srkrish2">Sneha</option>
			<option value="skchuen2">Sam</option>
		</select>!
	    </span>
	  </div>
	</nav>
	<div class="container-fluid">
	<div class="row">
		<div class="col-3" style="background-color:#13294b; height: 94.2%">
			<br>
			<table id="inbox_list" class="table table-hover table-bordered">
				<tr class='table-light'>
					<td>
						<button type="button" class="btn btn-light" onclick="openclose('makes')">Make</button>
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
						<button type="button" class="btn btn-light" onclick="openclose('models')">Model</button>
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
						<button type="button" class="btn btn-light" onclick="openclose('cities')">City, State</button>
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
						<button type="button" class="btn btn-light" onclick="openclose('years')">Year</button>
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
						<button type="button" class="btn btn-light" onclick="openclose('price_range')">Price</button>
						<div id='price_range' class="w3-container w3-hide pre-scrollable">
							<div class="form-inline">
								<input type='text' id="pricemin" placeholder='Min (eg 1999)'>
								<input type='text' id="pricemax" placeholder='Max(eg 2015)'>
							</div>
						</div>
					</td>
				</tr>
			</table>
			<button type='submit'  onclick=filtersearch() class='btn btn-primary'>Search</button>
		</div>

		<div class="col-9">
			<br>
			<div class="col-12">
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			</div>
			<hr>
			<div id='post_search_result'></div>
			<h1 id="post_id">Post #<?php echo $post_id?></h1>
			<?php
				if($post_id) {
					$query = 'SELECT * FROM posts WHERE post_id = '.$post_id;
					$result = mysqli_query($conn,$query);
					foreach($result as $row) {
						echo '<table class="table table-bordered table-dark">
							<tr><th>Make</th><td>'.$row['make'].'</td></tr>
							<tr><th>Model</th><td>'.$row['model'].'</td></tr>
							<tr><th>Year</th><td>'.$row['year'].'</td></tr>
							<tr><th>Mileage</th><td>'.$row['mileage'].'</td></tr>
							<tr><th>City</th><td>'.$row['city'].' ,'.$row['state'].'</td></tr>
							<tr><th>Price</th><td>$'.$row['price'].'</td></tr>
							<tr><th>Owner</th><td>'.$row['owner'].'</td></tr>
							<tr><td colspan=2><button onclick=message_user("'.$row['owner'].'") type="button" class="btn btn-success">Message</button></td></tr>
						</table>';
					}
				}

			?>
			<hr>
			<div id="chartContainer" style="height: 300px; width: 100%;"></div>
		</div>
</body>
<script>
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
