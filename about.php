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
		<?php echo file_get_contents('header.html') . "</br>"; ?>
		<img src="img/corner.png" width="9">
		<img src="img/border.png" width="692" height="9" border="0">
		<img src="img/corner2.png" width="9">
		<table align="center" width="710">
<!-- End Init -->
<?php
echo    '<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">';
echo    '<table align="center" width="710">';
echo        '<tr><th><h2>About Maralook</h2></th></tr>';
echo        '<tr><th><p></br>';
echo        $about_desc;
echo        'There are currently <strong>',$currows,'</strong> prices logged by Maralook!</br></br></br>';
echo        '<strong><a class="head" href="changes.php">Maralook Changelog</a></strong>';
echo        '</p></th></tr>';
echo        '<tr><th style="font-size: 85%;">'.$about_madeby.'</br>'.$about_use.'</th></tr>';
echo    '</table>';

echo    '<img src="img/corner3.png" width="9" ><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner4.png" width="9">';

echo '</div>';
echo '</html>'; 
?>