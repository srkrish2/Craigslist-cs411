<?php
	include_once('db_conn.php');
	$conn = connect_to_db();

	$query = 'select * from posts where '

	$nfilter = 0
	if( isset($_POST['year_min']) ){
		$year_min = $_POST['year_min'];
		$query = $query.' year > '.$year_min;
		$nfilter = $nfilter + 1
	}
	if( isset($_POST['year_max']) ){
		$year_max = $_POST['year_max'];
		if($nfilter != 0){
			$query = $query.' AND';
		}
		$query = $query.' year < '.$year_max;
		$nfilter = $nfilter + 1
	}
	if( isset($_POST['price_min']) ){
		$price_min = $_POST['price_min'];
		if($nfilter != 0){
			$query = $query.' AND';
		}
		$query = $query.' price > '.$price_min;
		$nfilter = $nfilter + 1
	}
	if( isset($_POST['price_max']) ){
		$price_max = $_POST['price_max'];
		if($nfilter != 0){
			$query = $query.' AND';
		}
		$query = $query.' price < '.$price_max;
		$nfilter = $nfilter + 1
	}
	if( isset($_POST['city']) ){
		$city = $_POST['city'];
		if($nfilter >0){
			$query = $query.' AND (';
		} else{
			$query = $query.'(';
		$n = 0
		foreach ($city as $c){
			if($n != 0){
				$query = $query.' OR';
			}
			$query = $query.' city == "'.$c.'"';
			$n = $n + 1
		}
		$nfilter = $nfilter + 1
	}
	if( isset($_POST['models']) ){
		$model = $_POST['models'];
		if($nfilter >0){
			$query = $query.' AND (';
		} else{
			$query = $query.'(';
		$n = 0
		foreach ($model as $c){
			if($n != 0){
				$query = $query.' OR';
			}
			$query = $query.' model == "'.$c.'"';
			$n = $n + 1
		}
		$nfilter = $nfilter + 1
	}
	if( isset($_POST['makes']) ){
		$makes = $_POST['makes'];
		if($nfilter >0){
			$query = $query.' AND (';
		} else{
			$query = $query.'(';
		$n = 0
		foreach ($makes as $c){
			if($n != 0){
				$query = $query.' OR';
			}
			$query = $query.' makes == "'.$c.'"';
			$n = $n + 1
		}
		$nfilter = $nfilter + 1
	}


	$result = mysqli_query($conn,$query);
	foreach($result as $row) {
		if($flag) {
			if($user == $row['receiver']) {
				$receiver = $row['sender'];
			} else {
				$receiver = $row['receiver'];
			}
			echo "Chatting with: <i id='message_receiver'>".$receiver."</i><hr>";
			$flag=0;
		}
		if($user == $row['sender']) {
			echo $row['sender'].': '.$row['message'].'<hr>';
		} else {
			echo '<span style="float:right;">'.$row['sender'].': '.$row['message'].'</span><hr>';
		}
	}
?>

