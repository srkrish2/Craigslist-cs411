<?php
session_start();
if(!isset($_SESSION['user'])) {
	$_SESSION['user'] = 'shahi2';
}
include_once('db_conn.php');
$conn = connect_to_db();
?>
<html>
<head>
        <title>Craigslist++</title>
        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous"></script>
        <!-- Bootstrap CDNs -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>
        <link   rel="stylesheet"
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
                <a class="nav-link" href="./index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./search.php">Search</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="./manage.php">Manage<span class="sr-only">(current)</span></a>
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
                <div class="col-3" style="background-color:#13294b; height: 100%">
                        <br>
                        <table id="inbox_list" class="table table-hover table-bordered">
                                <tr class="table-light"><td><button type="button" class = "btn" button onclick=sellandwatchfunc('selling')>  Selling</td>
                                <tr class="table-light"><td><button type="button" class = "btn" button onclick=sellandwatchfunc('watching')>  Watching</td>
                        </table>
                </div>
                <div class="col-9">
                        <br>

<div id = "selling" class ="content-manage" button onclick=mysellfunc()><h1>Listings</h1>
<hr>
<div id="posts">
<table id="manage_table" class="table table-bordered table-dark" style="width:100%">
<tr>
	<th>Post #</th><th>Make</th><th>Model</th><th>Year</th><th>Price</th><th>Mileage</th><th>City</th><th>State</th><th>VIN</th><th>Actions</th>
</tr>
<?php
                        $query = "SELECT * FROM posts WHERE owner='".$_SESSION['user']."'";
                        $result = mysqli_query($conn,$query);
			foreach($result as $row) {
				echo "<tr><td>".$row['post_id']."</td>
					<td id='make_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['make']."</td>
					<td id='model_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['model']."</td>
					<td id='year_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['year']."</td>
					<td id='price_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['price']."</td>
					<td id='miles_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['mileage']."</td>
					<td id='city_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['city']."</td>
					<td id='state_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['state']."</td>
					<td id='vin_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['VIN']."</td><td>
					<div class='btn-group btn-group-toggle' data-toggle='buttons'>
					  <label onclick=redir('".$row['post_id']."') class='btn btn-primary'>
					    <input type='radio' name='options' id='option1' autocomplete='off'>View
					  </label>
					  <label onclick=edit_post('".$row['post_id']."') class='btn btn-warning'>
					    <input type='radio' name='options' id='option2' autocomplete='off'> Edit
					  </label>
					  <label onclick=delete_post('".$row['post_id']."') class='btn btn-danger'>
					    <input type='radio' name='options' id='option3' autocomplete='off'> Delete
					  </label>
					</div>
					</td></tr>";
                        }
                ?>
<tr>
	<td></td><td id="make_new" class="editable newpost"></td><td id="model_new" class="editable newpost"></td><td id="year_new" class="editable newpost"></td><td id="price_new" class="editable newpost"></td><td id="miles_new" class="editable newpost"></td><td id="city_new" class="editable newpost"></td><td id="state_new" class="editable newpost"></td><td id="vin_new" class="editable newpost"></td><td><button onclick=add_post() type="button" class="btn btn-success">Add</button><button onclick=edit_all() type="button" class="btn btn-primary">Save All</button></td>
</tr>
</table>
</div>
</div>
<div id = "watching" class = "content-manage" button onclick=mywatchfunc() style = "display:none">Watching</div>
<script>
function change_user() {
	var user = $('#user').val();
	$.post("change_user.php",
	{
		user: user
	},
	function(data) {
		$('#posts').html(data);
	});
}

function sellandwatchfunc(div_id){
	$(".content-manage").hide();
	$("#"+div_id).show();
}

function redir(post_id) {
	window.location = "./search.php?post_id="+post_id;
}

function edit_post(post_id) {
	$('.'+post_id).each(function() {
		if($('#edit_'+this.id)) {	
			$(this).text($('#edit_'+this.id).val());
		}
	});
	var make = $('#make_'+post_id).text();
	var model = $('#model_'+post_id).text().trim();
	var year = $('#year_'+post_id).text();
	var price = $('#price_'+post_id).text();
	var miles = $('#miles_'+post_id).text();
	var city = $('#city_'+post_id).text();
	var state = $('#state_'+post_id).text();
	var vin = $('#vin_'+post_id).text();
	$.post("edit_post.php",
	  {
		post_id: post_id,
		make: make,
		model: model,
		year: year,
		price: price,
		miles: miles,
		city: city,
		state: state,
		vin: vin
	  },
	  function(data) {
	  	alert(data);
	  });
		
}

function edit_all() {
	var post_id_arr = [];
	var make_arr = [];
	var model_arr = [];
	var year_arr = [];
	var price_arr = [];
	var miles_arr = [];
	var city_arr = [];
	var state_arr = [];
	var vin_arr = [];	
	$('.editable').each(function() {
		if($('#edit_'+this.id)) {	
			$(this).text($('#edit_'+this.id).val());
		}
	});
	var post_id = '';
	$('#manage_table tr').each(function() {
		post_id = $(this).find('td').eq(0).text();
		if(post_id != 'Post #' && post_id != '') {
			post_id_arr.push(post_id);
			make_arr.push($('#make_'+post_id).text());
			model_arr.push($('#model_'+post_id).text().trim());
			year_arr.push($('#year_'+post_id).text());
			price_arr.push($('#price_'+post_id).text());
			miles_arr.push($('#miles_'+post_id).text());
			city_arr.push($('#city_'+post_id).text());
			state_arr.push($('#state_'+post_id).text());
			vin_arr.push($('#vin_'+post_id).text());
		}
	});
	$.post("edit_post_batch.php",
	  {
		post_id: post_id_arr,
		make: make_arr,
		model: model_arr,
		year: year_arr,
		price: price_arr,
		miles: miles_arr,
		city: city_arr,
		state: state_arr,
		vin: vin_arr
	  },
	  function(data) {
	  	alert(data);
	  });
}

function delete_post(post_id) {
	$.post("delete_post.php",
	{
		post_id: post_id
	},
	function(data) {
		alert(data);
	});
	location.reload();
}

function add_post() {	
	var make = $('#edit_make_new').val();
	var model = $('#edit_model_new').val();
	var year = $('#edit_year_new').val();
	var price = $('#edit_price_new').val();
	var miles = $('#edit_miles_new').val();
	var city = $('#edit_city_new').val();
	var state = $('#edit_state_new').val();
	var vin = $('#edit_vin_new').val();
	$.post("add_post.php",
	  {
		make: make,
		model: model,
		year: year,
		price: price,
		miles: miles,
		city: city,
		state: state,
		vin: vin
	  },
	   function(data) {
	  	alert(data);
	  });
	location.reload();
}
$('.editable').dblclick(function(e) {
	var edit_text = $(this).text();
	$(this).html('<input id="edit_'+this.id+'" style="width:100%" value="'+edit_text+'"></input>');
	$('#edit_'+this.id).focus();
	return false;
});

</script>

<html>
</body>
<style>
.editable {
	cursor: pointer;
}
</style>
</html>






