<?php
include_once('db_conn.php');
$conn = connect_to_db();
if(!empty($_GET['post_id'])) {
	$post_id = $_GET['post_id'];
}
?>
<html>
<head>
	<?php include('./header_stuff.php'); ?>
</head>
<body>
	<?php include('./nav_bar.php'); ?>
	<div class="container-fluid">
	<div class="row">
		<div class="col-3" style="background-color:#13294b; height: 100%">
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
			<h1>Post #<?php echo $post_id?></h1>
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
						</table>';
					}
				}
				
			?>
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
