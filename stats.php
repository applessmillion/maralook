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

#Returns most recent item, in ID or Name
elseif(isset($_GET['recent-log'])){
$sql = "SELECT * FROM Pricelog ORDER BY Timestamp DESC LIMIT 1;";
$row=mysqli_fetch_array(mysqli_query($con, $sql), MYSQL_ASSOC);
	if(isset($_GET['name'])){
		$iid = $row['ItemID'];
		$sql = "SELECT * FROM Names WHERE ItemID like '$iid' ORDER BY ItemName ASC LIMIT 1";
		$row=mysqli_fetch_array(mysqli_query($con, $sql), MYSQL_ASSOC);
		$output = $row['ItemName'];
	}
	else{
		$output = $row['ItemID'];
	}
echo $output;
}

#Returns the name associated with an ID #####IN DEVELOPMENT
elseif(isset($_GET['lookup-name'])){
	if(isset($_GET['id'])){
		$iid = $_GET['id'];
		$sql = "SELECT * FROM Names WHERE ItemID like '$iid' ORDER BY ItemName ASC LIMIT 1";
		$row=mysqli_fetch_array(mysqli_query($con, $sql), MYSQL_ASSOC);
		
		$output = $row['ItemName'];
		
		if($output = NULL OR $output = "")
		{
			$output = "NULL ITEM";
		}
	}
	else{
		$output = "Please add the ID you're looking up by adding '&id=###' to the end of this URL.";
	}
	
echo $output;
}

?>

</html>
