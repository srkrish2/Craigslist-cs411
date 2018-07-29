<?php
include_once('db_conn.php');
session_start();
$conn = connect_to_db();
$user = $_POST['user'];
$_SESSION['user'] = $user;
echo $_SESSION['user'];
?>
<table class="table table-bordered table-dark" style="width:100%">
<tr>
	<th>Post #</th><th>Make</th><th>Model</th><th>Year</th><th>Price</th><th>Mileage</th><th>City</th><th>State</th><th>VIN</th><th>Actions</th>
</tr>
<?php
                        $query = "SELECT * FROM posts WHERE owner='".$user."'";
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
	<td></td><td id="make_new" class="editable newpost"></td><td id="model_new" class="editable newpost"></td><td id="year_new" class="editable newpost"></td><td id="price_new" class="editable newpost"></td><td id="miles_new" class="editable newpost"></td><td id="city_new" class="editable newpost"></td><td id="state_new" class="editable newpost"></td><td id="vin_new" class="editable newpost"></td><td><button onclick=add_post() type="button" class="btn btn-success">Add</button></td>
</tr>
</table>
