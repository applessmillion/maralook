<?php
include_once 'config.php';
include_once 'vars.php';

$con = new mysqli($ip,$user,$pw,$db);

$sqlcheck = "SELECT * FROM Pricelog ORDER BY Timestamp DESC LIMIT 1;";
$row=mysqli_fetch_array(mysqli_query($con, $sqlcheck), MYSQL_ASSOC);
$currows = $row['LogID'];

?>    
<html>
<!-- Initalize Page -->
	<head>
		<title>Maralook - Contributors</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="main">
		<?php echo file_get_contents('header.html')?>
		</br>
<!-- End Init -->
		<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">
		<table align="center" width="710">
		<tr>
			<th>
				<h2>About Maralook</h2>
			</th>
		</tr>
		<tr>
			<th>
				<p>
				<br>
<?php
echo $about_desc;
?>
				</p>
			</th>
		</tr>
<?php
echo        '<tr><th style="font-size: 85%;">'.$about_madeby.'</br>'.$about_use.'</th></tr>';
?>
		</table>
		<img src="img/corner3.png" width="9" ><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner4.png" width="9">
	</div>
</html>
