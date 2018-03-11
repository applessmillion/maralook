<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
include_once 'config.php';
include_once 'vars.php';
include_once('simple_html_dom.php');

##########CONNECTION INFO FOR DATABASE###########
$con = new mysqli($ip,$user,$pw,$db);
############STARTING CONTENT#############

#CODE FOR SEARCHING DATABASE AND PRINTING RESULTS#
if(isset($_GET["min"])) {
?>    
<html>
	<!-- Initalize Page -->
	<head>
		<title>Maralook - Price Search</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="main">
			<?php echo file_get_contents('header.html') . "</br>"; ?>
			<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">
			<table align="center" width="710">
	<!-- End Init -->

<?php

	//Variables needed for searching.
    $srch = $_GET["min"];
    $srch2 = $_GET["max"];
    $name = $_GET["search"];

	//Kicks in if no input for the maximum field. 500k is the max. price for MP.
    if($srch2 < 0 OR $srch2 == NULL)
    {
        $srch2 = 5000000;
    }
	//Kicks in if no input for the minimum field.
    if($srch < 0 OR $srch == NULL)
    {
        $srch = 1;
    }
    if($name == NULL)
    {
        $name = ' ';
    }
    
    #GET NAME FROM SEARCH TERMS#
    $search_query = mysqli_query($con, "SELECT * FROM Names WHERE LastPrice>='$srch' AND LastPrice<='$srch2' AND ItemName LIKE '%$name%' ORDER BY LastPrice ASC LIMIT 50");
    $search_nums = mysqli_num_rows($search_query);
    
    echo '<tr><th><a href="price.php"><img src="img/search-price.png"></a></th></tr>';
    
    if($search_nums > 0)
    {
		echo '<tr><th><h2>Found '. $search_nums .' items!</h2></th></tr>';
		echo '<tr><th><hr style="border-color:#6D7ACE; width:55%;"></th></tr>';
		while ($obj = mysqli_fetch_object($search_query)) {
			echo "<tr><th><a class='reg' href='item.php?info=" . urlencode($obj->ItemName) . "'>" . $obj->ItemName," (", $obj->LastPrice,"MP)</a><strong> [<a target='_blank' class='reg' href='http://www.marapets.com/shopsearch.php?do=" . $obj->ItemName . "'>Shop Search</a>]</strong>";
			if($obj->SecondaryName != NULL)
			{
				echo "  (" . $obj->SecondaryName . ") </a><br /></th></tr>";
			}
        
		}
    }
	
    //If the user has an amount higher than 500k, let them know why it won't work.
    elseif($srch > 500000)
    { ?>
		<tr>
			<th>
				<h2>Oops!</h2>
			</th>
		</tr>
    <tr><th><hr style="border-color:#6D7ACE; width:55%;"></th></tr>';
    <tr><th>It appears your minimum price was over 500,000MP. Player shops cannot price anything over 500,000MP, so we do not have anything to display!</th></tr>
	<?php
    }
    elseif($search_nums == 0)
    { ?>
		<tr>
			<th>
				<h2>No items were found!</h2>
			</th>
		</tr>
		<tr>
			<th>
				<hr style="border-color:#6D7ACE; width:55%;">
			</th>
		</tr>
		<tr>
			<th>Try searching with a different minimum or maximum, because there were no items in that range!</th>
		</tr>
	<?php
    } ?>
    <tr>
		<td style="height:20px;">
			</br>
			<a href="javascript:history.go(-1)">Back to Search...</a>
		</td>
	</tr>
<?php
}
else { ?>
<html>
	<!-- Initalize Page -->
	<head>
		<title>Maralook - Search Prices</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="main">
			<?php echo file_get_contents('header.html') . "</br>"; ?>
			<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">
			<table align="center" width="710">
	<!-- End Init -->
				<tr>
					<th>
						<a href="price.php">
							<img src="img/search-price.png">
						</a>
					</th>
				</tr>
				<tr>
					<th>
						<img src="img/titles/price-search.png">
					</th>
				</tr>
				<tr>
					<td style="height:8px" ></td>
				</tr>
				<tr>
					<th>
					<?php echo '<p>' , $price_desc , '</p></br></br>'; ?>
					</th>
				</tr>
				<tr>
					<th>
						<form action="price.php" method="get"></br>
							<strong>Minimum Price: </strong>
							<input type="text" name="min" maxlength="8" size="8"></br></br>
							<strong>Maximum Price: </strong><input type="text" name="max" maxlength="8" size="8"></br></br>
							<strong>Search Term: </strong><input type="text" name="search" maxlength="34" size="16"></br></br>
							<input type="submit" value="Search">
						</form></br></br></br>
					</th>
				</tr>
			</table>
<?php }  ?>
<tr>
	<td style="height:10px"></td>
</tr>
</table>
<img src="img/corner3.png" width="9" ><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner4.png" width="9">
</div>
</body>
</html>