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
