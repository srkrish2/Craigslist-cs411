<?php
	include_once('./db_conn.php');
	$conn = connect_to_db();

	$q_year = "SELECT DISTINCT Year FROM posts";
	$filter_year = mysqli_query($conn,$query);
	$q_city = "SELECT DISTINCT City FROM posts";
	$filter_city = mysqli_query($conn,$query);
	$q_state = "SELECT DISTINCT State FROM posts";
	$filter_state = mysqli_query($conn,$query);
	$q_price_max = "SELECT MAX(Price) FROM posts";
	$filter_price_max = mysqli_query($conn,$query);
	$q_price_min = "SELECT MIN(Price) FROM posts";
	$filter_price_min = mysqli_query($conn,$query);
	$q_miles_max = "SELECT MAX(Miles) FROM posts";
	$filter_miles_max = mysqli_query($conn,$query);
	$q_miles_min = "SELECT MIN(Miles) FROM posts";
	$filter_miles_min = mysqli_query($conn,$query);
	$q_location = "SELECT DISTINCT Location FROM posts";
	$filter_location = mysqli_query($conn,$query);
	$q_make = "SELECT DISTINCT Make FROM posts";
	$filter_make = mysqli_query($conn,$query);
	$q_model = "SELECT DISTINCT Model FROM posts";
	$filter_model = mysqli_query($conn,$query);
?>

<html>
<head>
	<?php include('./header_stuff.php'); ?>
</head>
<body>
	<!-- navigation bar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="#">Craigslist++</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item">
	  <a class="nav-link" href="#">Home</a>
	      </li>
	      <li class="nav-item active">
	  <a class="nav-link" href="#">Search<span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	  <a class="nav-link" href="#">Manage</a>
	      </li>
	      <li class="nav-item">
	  <a class="nav-link" href="#">Inbox</a>
	      </li>
	    </ul>
	    <span class="navbar-text">
	  Welcome, User1!
	    </span>
	  </div>
	</nav>

	<div class="container-fluid">
	<div class="row">
		<div class="col-3" style="background-color:#13294b; height: 100%">
			<?php echo $filter_year; ?>
			<br>
			<table id="inbox_list" class="table table-hover table-bordered">
				<tr class="table-light"><td><input type="checkbox">  Filter 1</td></tr>
				<tr class="table-light"><td><input type="checkbox">  Filter 2</td></tr>
				<tr class="table-light"><td><input type="checkbox">  Filter 3</td></tr>
				<tr class="table-light"><td><input type="checkbox">  Filter 4</td></tr>
				<tr class="table-light"><td><input type="checkbox">  Filter 5</td></tr>
				<tr class="table-light"><td><input type="checkbox">  Filter 6</td></tr>
			</table>
		</div>
		<div class="col-9">
			<br>
			<div class="col-12">
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			</div>
			<hr>
			<h1>Post 1</h1>
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
			<ul>
			   <li>Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.</li>
			   <li>Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</li>
			   <li>Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. Nam nulla quam, gravida non, commodo a, sodales sit amet, nisi.</li>
			   <li>Pellentesque fermentum dolor. Aliquam quam lectus, facilisis auctor, ultrices ut, elementum vulputate, nunc.</li>
			</ul>
		</div>
	</div>
	</div>
</body>
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
