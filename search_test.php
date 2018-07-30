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
	} else {

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
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
		<div class="col-3" style="background-color:#13294b; height: 100%">
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
									  <input class="form-check-input" type="checkbox" value="'.'" id="defaultCheck1">
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
                                                                          <input class="form-check-input" type="checkbox" value="'.'" id="defaultCheck1">
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
                                                                          <input class="form-check-input" type="checkbox" value="'.'" id="defaultCheck1">
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
								<input type='text' placeholder='Min (eg 1999)'>
								<input type='text' placeholder='Max(eg 2015)'>
                                                </div>
                                        </td>
                                </tr>
				<tr class="table-light">
					<td>
                                                <button type="button" class="btn btn-light" onclick="openclose('price_range')">Price</button>
                                                <div id='price_range' class="w3-container w3-hide pre-scrollable">
                                                </div>
                                        </td>
                                </tr>
			</table>
		</div>
		<div class="col-9">
			<br>
			<div class="col-12 form-inline">
					<input id='text_for_search' class="form-control mr-sm-2"  placeholder="Search">
					<button type="submit" onclick=text_search() class="btn btn-success">Search</button>
			</div>
			<hr>
			<h1 id="post_id">Post #<?php echo $post_id?></h1>
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			  <ol class="carousel-indicators">
			    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			  </ol>
			  <div class="carousel-inner">
			    <div class="carousel-item active">
			      <img class="d-block w-40" src="https://picsum.photos/200/300/?image=0" alt="First slide">
			    </div>
			    <div class="carousel-item">
			      <img class="d-block w-40" src="https://picsum.photos/200/300/?image=1" alt="Second slide">
			    </div>
			    <div class="carousel-item">
			      <img class="d-block w-40" src="https://picsum.photos/200/300/?image=2" alt="Third slide">
			    </div>
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
			<hr>
			<div id='post_search_result'></div>
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
		</div>
	</div>
		<h2> Enter distance (in miles): </hs>

		<form action="/action_page.php">
		First name:<br>
		<input type="text" name="firstname" value="michey">
		<br>
	
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
		/*$.post("get_post.php",
		{
			post_id:text
		},
		function(data) 
		{
			$('#post_search_result').html(data);
		});*/
		window.location.replace("search2.php?post_id="+text);
	} else {
		$.post("full_search.php",
		{
			text: text
		},
		function(data)
		{
			$('#post_search_result').html(data);
		});
	}
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
