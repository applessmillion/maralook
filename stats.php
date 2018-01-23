<?php
include_once 'config.php';
?>    
<html>
<!-- Initalize Page -->
	<head>
		<title>Is this kind of an API?</title>
	</head>

<?php
$con = new mysqli($ip,$user,$pw,$db);

#Returns total number of price logs Maralook has, well, logged
if(isset($_GET['total-logs'])){
$sql = "SELECT * FROM Pricelog ORDER BY Timestamp DESC LIMIT 1;";
$row=mysqli_fetch_array(mysqli_query($con, $sql), MYSQL_ASSOC);
$output = $row['LogID'];

echo $output;
}

#Returns total users that have registered their name as a contributor
elseif(isset($_GET['total-users'])){
$sql = "SELECT * FROM Userboard ORDER BY Start DESC LIMIT 1;";
$row=mysqli_fetch_array(mysqli_query($con, $sql), MYSQL_ASSOC);
$output = $row['UserID'];

echo $output;
}

#Returns total users that have registered their name as a contributor
elseif(isset($_GET['recent-logs'])){
	if(isset($_GET['n'])){
		$num = $_GET['n'];
	}
	else{
		$num = 1;
	}
$sql = "SELECT * FROM Pricelog ORDER BY Timestamp DESC LIMIT $num;";
$row=mysqli_fetch_array(mysqli_query($con, $sql), MYSQL_ASSOC);
$output = $row['UserID'];

echo $output;
}

?>

</html>
