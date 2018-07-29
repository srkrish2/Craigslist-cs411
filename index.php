<?php
include_once('./db_conn.php');
$conn = connect_to_db();
?>
<html>
<head>
	<title>Craigslist++</title>
	<!-- jQuery CDN -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
		integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
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
</head>
<body>
	<div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="#">Craigslist++</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav">
		      <li class="nav-item active">
			<a class="nav-link" href="./index.php">Home<span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
			<a class="nav-link" href="./search.php">Search</a>
		      </li>
		      <li class="nav-item">
			<a class="nav-link" href="./manage.php">Manage</a>
		      </li>
		      <li class="nav-item">
			<a class="nav-link" href="./inbox.php">Inbox</a>
		      </li>
		    </ul>
		  </div>
		</nav>
	</div>
	<div class="container-fluid">
	<table class="table table-bordered table-striped">
		<thead>
			<tr><th>Price</th><th>Year</th><th>Mileage</th><th>City</th><th>State</th><th>VIN</th><th>Make</th><th>Model</th></tr>
		</thead>
		<tbody>
			<?php
				$query = "SELECT * FROM posts WHERE post_id < 20";
				$result = mysqli_query($conn,$query);
				foreach($result as $row) {
					echo '<tr>
						<td>'.$row['price'].'</td>
						<td>'.$row['year'].'</td>
						<td>'.$row['mileage'].'</td>
						<td>'.$row['city'].'</td>
						<td>'.$row['state'].'</td>
						<td>'.$row['VIN'].'</td>
						<td>'.$row['make'].'</td>
						<td>'.$row['model'].'</td>
					</tr>';
				}
			?>
		</tbody>
	</table>
	</div>
</body>
</html>
<?php
	mysqli_close($conn);
?>
