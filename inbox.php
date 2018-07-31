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
		<a class="nav-link" href="./index.php">Home</a>
	      </li>
	      <li class="nav-item">
		<a class="nav-link" href="./search.php">Search</a>
	      </li>
	      <li class="nav-item">
		<a class="nav-link" href="./manage.php">Manage</a>
	      </li>
	      <li class="nav-item active">
		<a class="nav-link" href="./inbox.php">Inbox<span class="sr-only">(current)</span></a>
	      </li>
	    </ul>
	    <span class="navbar-text">
		Welcome, <select onchange=load_message_list() id="user">
			<option value="shahi2" <?php if($_SESSION['user'] == 'shahi2') echo 'selected';?>>Teesh</option>
			<option value="srkrish2" <?php if($_SESSION['user'] == 'srkrish2') echo 'selected';?>>Sneha</option>
			<option value="skchuen2" <?php if($_SESSION['user'] == 'skchuen2') echo 'selected';?>>Sam</option>
		</select>!
	    </span>
	  </div>
	</nav>
	<div class="container-fluid">
	<div class="row">
		<div class="col-3" style="background-color:#13294b; height: 94.2%">
			<br>
			<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			<hr>
			<div id="message_list">
			<table id="inbox_list" class="table table-hover table-bordered">
			<?php
				$query = "SELECT DISTINCT post_id FROM messages WHERE sender = '".$_SESSION['user']."' OR receiver = '".$_SESSION['user']."'";
				$result = mysqli_query($conn,$query);
				foreach($result as $row) {
					echo '<tr class="table-light"><td class="message" onclick=load_message('.$row['post_id'].') id="msg_'.$row['post_id'].'">Message '.$row['post_id'].'</td></tr>';
				}
			?>
			</table>
			</div>
		</div>
		<div class="col-9" style="overflow-y:hidden">
			<br>
			<div class="row"> 
				<div class="col-12" style="height:5%">
					<form onsubmit="return send_message()">
					<div class="form-row">
						<div class="col">
							<input id="message_buffer" class="form-control mr-sm-2" placeholder="Send message">
						</div>
						<div class="col">
							<button type="submit" class="btn btn-success">Send</button>
						</div>
					</div>
					</form>
				</div>
			</div>
			<div>
				<div class="col-12" style="overflow-y:scroll;height:85%">
					<div id="message-content"></div>
				</div>
			</div>
		</div>
	</div>
	</div>
</body>
<script>
	var current_post_id = '';
	var message_interval = '';
	function send_message() {
		var message = $('#message_buffer').val();
		var sender = $('#user').val();
		var receiver = $('#message_receiver').text();
		$.post("send_message.php",
		{
			message:message,
			sender:sender,
			receiver:receiver,
			post_id:current_post_id
		},
		function(data) {
			load_message(current_post_id);
		});
		$('#message_buffer').val('');
		return false;
	}
	function load_message_list() {
		clearInterval(message_interval);
		user = $('#user').val();
		$.post("load_message_list.php",
		{
			user:user 
		},
		function(data) {
			$('#message_list').html(data);
		});
		$('#message-content').html('');
		current_post_id = '';
	}

	function load_message(post_id) {
		clearInterval(message_interval);
		current_post_id = post_id;
		var text = $('#msg_'+post_id).text();
		var temp_text = '';
		var user = $('#user').val();
		$('.message').each(function () {
			temp_text = $(this).text();
			$(this).html(temp_text);
		});
		$('#msg_'+post_id).html('<b>'+text+'</b>');
		$.post("load_message.php",
		{
			post_id: post_id,
			user:user 
		},
		function(data) {
			$('#message-content').html(data);
			message_interval = setInterval(function() { load_message(post_id)}, 1000); 
		});
	}
</script>
<style>
td {
	cursor:pointer;
}
#inbox_list {
	border-spacing: 15px;
}
#inbox_list td {
	padding: 20px;
}
::-webkit-scrollbar {
    width: 0px;
    background: transparent;
}
* {
  -ms-overflow-style: none !important;
}
</style>
</html>

