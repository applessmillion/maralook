<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
include_once 'config.php';
include_once 'vars.php';
include_once('simple_html_dom.php');

##################CONNECTION INFO FOR DATABASE###################
    $con = new mysqli($ip,$user,$pw,$db);
    if ($con->connect_error) {
        echo "Failed to connect to MySQL: " . $con->connect_error;
    }
    
########################STARTING CONTENT#########################


#CODE FOR SEARCHING DATABASE AND PRINTING RESULTS#
if(isset($_GET["search"])) {
?>    
<html>
<!-- Initalize Page -->
	<head>
		<title>Maralook - Item Search</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="main">
		<?php echo file_get_contents('header.html') . "</br>"; ?><img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">
		<table align="center" width="710">
<!-- End Init -->
<?php
    $name = $_GET["search"];
    #GET NAME FROM SEARCH TERMS#
    $search_query = mysqli_query($con, "SELECT * FROM Names WHERE ItemName like '%$name%' OR SecondaryName like '%$name%' ORDER BY ItemName ASC LIMIT 50");
    $search_nums = mysqli_num_rows($search_query);
    
    echo '<tr><th><a href="item.php"><img src="img/search-item.png"></a></th></tr>';
    echo '<tr><th><h2>Found '. $search_nums .' results for "'. $_GET["search"] . '"...</h2></th></tr>';
    echo '<tr><th><hr style="border-color:#6D7ACE; width:55%;"></th></tr>';
    while ($obj = mysqli_fetch_object($search_query)) {
        echo "<tr><th><a class='reg' href='?info=" . urlencode($obj->ItemName) . "'> " . $obj->ItemName;
        if($obj->SecondaryName != NULL)
        {
           echo "  (" . $obj->SecondaryName . ") </a><br /></th></tr>";
        }        
    }   
    echo '<tr><td style="height:20px;"></br><a href="javascript:history.go(-1)">Back to Search...</a></td></tr>';
}

#CODE FOR RETRIEVING DATA OF ITEM AND PRINTING RESULTS#
elseif(isset($_GET["info"])) {
        
        $info = urldecode($_GET["info"]);
        $search = mysqli_escape_string($con, $info);
        $query = mysqli_query($con, "SELECT * FROM Names WHERE ItemName='$info'");
        $obj = mysqli_fetch_object($query);
        $iid = $obj->ItemID;
        
        $pricehistory = mysqli_query($con, "SELECT * FROM Pricelog WHERE ItemID='$iid' ORDER BY Timestamp DESC LIMIT 16");
        $pricehistory2 = mysqli_query($con, "SELECT * FROM Pricelog WHERE ItemID='$iid' ORDER BY Timestamp DESC LIMIT 500");
        $price_nums = mysqli_num_rows($pricehistory);		
?>    
<html>
<!-- Initalize Page -->
	<head>
		<?php echo '<title>Maralook Info - ' . urldecode($_GET["info"]) . '</title>'; ?>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="main">
		<?php echo file_get_contents('header.html') . "</br>"; ?>
		<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">
		<table align="center" width="710">
<!-- End Init -->
<?php
        if($iid == NULL) {
        $marapage = '<h2 style="color:red;">Item Not Found!</h2></br>Please return to the search and try again.';
                #BACK BUTTON TEXT - BACK TO RESULTS#
        echo "<th>" . $marapage . "</br></br></th>"; 
        echo '<tr><td style="height:20px;"><a href="javascript:history.go(-1)">Back to Results</a></td></tr>';
        }
        else {
            echo "<tr><th><h2>Displaying info for ". $info.".</h2></th></tr>"; 
            
            $pid = pcntl_fork();
            if ($pid == 0) {
                try {
                $marapage = file_get_html('http://maralook.com/pricecopier.php?id=' . $iid);
                echo '<tr><th>' . file_get_html("http://maralook.com/pricecopier.php?id=$iid") . '</th></tr>';
                }
                catch(Exception $e3){
                echo 'Error: Could not fetch item info. Refresh and try again';
                }
                try{
                    foreach($marapage->find('a font[color="#5F148D"]') as $pprice); 
                    $pprice = preg_replace("/[^0-9.]/", "", $pprice->plaintext);
                
                    $sql = "INSERT INTO Pricelog (ItemID, PlayerPrice) VALUES ('$iid', '$pprice');";
                    $sql2 = "UPDATE Names SET LastPrice='$pprice' WHERE ItemID=$iid";
                    $sqlcheck = "SELECT * FROM Pricelog WHERE ItemID='$iid' ORDER BY Timestamp DESC LIMIT 1;";

                    $row=mysqli_fetch_array(mysqli_query($con, $sqlcheck), MYSQL_ASSOC);
                    $timest = $row['Timestamp'];
                    $time = strtotime($timest);
                    $curprice = $row['PlayerPrice'];
                    $curtime = time();
                    if($pprice == 0)
                    {
                        echo '<tr><th style="font-size: 90%; color:red">This item is not listed right now, or else we would log it!</th></tr>';

                    }
                    elseif(($curtime-$time) >= 29251 AND $pprice != $curprice) {
                        $con->query($sql);
                        $con->query($sql2);
                        echo '<tr><th style="font-size: 95%; color: #009900">Latest price added to history! Refresh to see the change!</th></tr>';
                    
                        if(isset($_COOKIE['ml_user'])){
                            $username = $_COOKIE['ml_user'];
                            $sql3 = "UPDATE Userboard SET Submissions=Submissions+1 WHERE Username='$username'";
                            $con->query($sql3);
                        }
                        else{
                            $username = "Anonymous";
                            $sql3 = "UPDATE Userboard SET Submissions=Submissions+1 WHERE Username='$username'";
                            $con->query($sql3);
                        }
                    }
                
                    elseif($pprice = $curprice AND ($curtime-$time) >= 29250) {
                        echo '<tr><th style="font-size: 90%; color: #E59437">It seems the price has not changed since last checked!</th></tr>';
                    }
                } catch (Exception $e) {
                    $marapage = '<h2 style="color:red;">Timed Out!</h2></br>Something prevented us from getting a live look at this item.</br>Try again later to add prices, for now, here is the history...';
                    echo "<th>" . $marapage . "</br></br></th>"; 
                }
            
            } else {
                // this is the parent process, and we know the child process id is in $pid
                sleep(5); // wait 4 seconds
                posix_kill($pid, SIGKILL); // then kill the child
                $marapage = '<h2 style="color:red;">Timed Out!</h2></br>Something prevented us from getting a live look at this item.</br>Try again later to add prices, for now, here is the history...';
                echo "<th>" . $marapage . "</br></br></th>"; 
            }
            $avgsql = "SELECT AVG(PlayerPrice) from Pricelog WHERE ItemID='$iid';"; 
			$avg2sql = "SELECT AVG(PlayerPrice) from ( SELECT PlayerPrice FROM Pricelog WHERE ItemID='$iid' ORDER BY Timestamp DESC LIMIT 15) AS QRY;"; 
			$hisql = "SELECT * from Pricelog WHERE ItemID='$iid' ORDER BY PlayerPrice DESC LIMIT 1;"; 
			$losql = "SELECT * from Pricelog WHERE ItemID='$iid' ORDER BY PlayerPrice ASC LIMIT 1;"; 
            
			$row= mysqli_fetch_array(mysqli_query($con, $avg2sql), MYSQL_ASSOC);             
            $avg2p = $row['AVG(PlayerPrice)'];
			
			$row= mysqli_fetch_array(mysqli_query($con, $avgsql), MYSQL_ASSOC);             
            $avgp = $row['AVG(PlayerPrice)'];
			
			$highs= mysqli_fetch_array(mysqli_query($con, $hisql), MYSQL_ASSOC);        
			$lows= mysqli_fetch_array(mysqli_query($con, $losql), MYSQL_ASSOC);        
			
			#$datehi = $highs['Timestamp'];
			#$datelo = $highs['Timestamp'];
			$highp = $highs['PlayerPrice'];
			$lowp = $lows['PlayerPrice'];

            echo '<tr><th><hr style="border-color:#6D7ACE; width:55%;"></th></tr>';
            echo "<tr><th><h3>Recent Average: " . number_format($avg2p) ."MP</h3>";
			echo "<tr><th><strong>All-Time Average: " . number_format($avgp) ."MP</strong>";
			echo "<tr><th><strong>All-Time High:</strong> " . number_format($highp) ."MP </br>";
			echo "<tr><th><strong>All-Time Low:</strong> " . number_format($lowp) ."MP </br></br>";
            echo "Based on <strong>" . mysqli_num_rows($pricehistory2) ."</strong> recorded prices for this item.</th></tr>";
            echo '<tr><th><hr style="border-color:#6D7ACE; width:50%;"></th></tr>';
            echo "<tr><th><h2>Price History</h2></th></tr>";
            if(mysqli_num_rows($pricehistory)==0) {
            echo '<tr><th style="color: #E01200">This item has no recorded prices!</br>It must be quite the rare item...</th></tr>';
            }
            
            #PRINT PRICE HISTORY#
            while ($objph = mysqli_fetch_object($pricehistory)) {
                $dt = new DateTime($objph->Timestamp);
                echo "<tr><th style='font-size: 100%;'>Priced at <strong>" . number_format($objph->PlayerPrice) . "MP</strong> on " . $dt->format('M j Y H:i') . "</th></tr>";
            }
        echo '<tr><td style="height:30px"></td></tr>';
        #BACK BUTTON TEXT - BACK TO RESULTS#
        echo '<tr><td style="height:20px;"></br><a href="javascript:history.go(-1)">Back to Results</a></td></tr>';
        }
        if(isset($_GET["id"])) {
        echo '<tr><td style="height:20px;"></br><h3>Item ID:'. $iid  .'</h3></td></tr>';
        }
        
}
elseif(isset($_GET["random"])) {
        
        $iid = mt_rand(1, 47400);
        
        $pricehistory = mysqli_query($con, "SELECT * FROM Pricelog WHERE ItemID like $iid ORDER BY Timestamp DESC LIMIT 15");
        $pricehistory2 = mysqli_query($con, "SELECT * FROM Pricelog WHERE ItemID like $iid ORDER BY Timestamp DESC LIMIT 500");
        $price_nums = mysqli_num_rows($pricehistory);

?>    
<html>
<!-- Initalize Page -->
	<head>
		<title>Maralook - Item Search</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="main">
		<?php echo file_get_contents('header.html') . "</br>"; ?>
		<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">
		<table align="center" width="710">
<!-- End Init -->

<?php
        
        if($iid == NULL) {
        $marapage = '<h2 style="color:red;">Item Not Found!</h2></br>Please return to the search and try again.';
                #BACK BUTTON TEXT - BACK TO RESULTS#
        echo "<th>" . $marapage . "</br></br></th>"; 
        echo '<tr><td style="height:20px;"><a href="javascript:history.go(-1)">Back to Results</a></td></tr>';
        }
        else {
            echo "<tr><th><h2>Displaying info for ". $info.".</h2></th></tr>"; 
            
            $pid = pcntl_fork();
            if ($pid == 0) {
                try {
                $marapage = file_get_html('http://maralook.com/pricecopier.php?id=' . $iid);
                echo '<tr><th>' . file_get_html("http://maralook.com/pricecopier.php?id=$iid") . '</th></tr>';
                }
                catch(Exception $e3){
                echo 'Error: Could not fetch item info. Refresh and try again';
                }
                try{
                    foreach($marapage->find('a font[color="#5F148D"]') as $pprice); 
                    $pprice = preg_replace("/[^0-9.]/", "", $pprice->plaintext);
                
                    $sql = "INSERT INTO Pricelog (ItemID, PlayerPrice) VALUES ('$iid', '$pprice');";
                    $sql2 = "UPDATE Names SET LastPrice='$pprice' WHERE ItemID=$iid";
                    $sqlcheck = "SELECT * FROM Pricelog WHERE ItemID='$iid' ORDER BY Timestamp DESC LIMIT 1;";

                    $row=mysqli_fetch_array(mysqli_query($con, $sqlcheck), MYSQL_ASSOC);
                    $timest = $row['Timestamp'];
                    $time = strtotime($timest);
                    $curprice = $row['PlayerPrice'];
                    $curtime = time();
                    if($pprice == 0)
                    {
                        echo '<tr><th style="font-size: 90%; color:red">This item is not listed right now, or else we would log it!</th></tr>';

                    }
                    elseif(($curtime-$time) >= 29251 AND $pprice != $curprice) {
                        $con->query($sql);
                        $con->query($sql2);
                        echo '<tr><th style="font-size: 95%; color: #009900">Latest price added to history! Refresh to see the change!</th></tr>';
                    
                        if(isset($_COOKIE['ml_user'])){
                            $username = $_COOKIE['ml_user'];
                            $sql3 = "UPDATE Userboard SET Submissions=Submissions+1 WHERE Username='$username'";
                            $con->query($sql3);
                        }
                        else{
                            $username = "Anonymous";
                            $sql3 = "UPDATE Userboard SET Submissions=Submissions+1 WHERE Username='$username'";
                            $con->query($sql3);
                        }
                    }
                
                    elseif($pprice = $curprice AND ($curtime-$time) >= 29250) {
                        echo '<tr><th style="font-size: 90%; color: #E59437">It seems the price has not changed since last checked!</th></tr>';
                    }
                } catch (Exception $e) {
                    $marapage = '<h2 style="color:red;">Timed Out!</h2></br>Something prevented us from getting a live look at this item.</br>Try again later to add prices, for now, here is the history...';
                    echo "<th>" . $marapage . "</br></br></th>"; 
                }
            
            } else {
                // this is the parent process, and we know the child process id is in $pid
                sleep(6); // wait 4 seconds
                posix_kill($pid, SIGKILL); // then kill the child
                $marapage = '<h2 style="color:red;">Timed Out!</h2></br>Something prevented us from getting a live look at this item.</br>Try again later to add prices, for now, here is the history...';
                echo "<th>" . $marapage . "</br></br></th>"; 
            }
            try{
            $avgsql = "SELECT AVG(PlayerPrice) from Pricelog WHERE ItemID='$iid' LIMIT 500;"; 
            $row=mysqli_fetch_array(mysqli_query($con, $avgsql), MYSQL_ASSOC);             
            $avgp = $row['AVG(PlayerPrice)'];
            }
            catch(Exception $e){
                echo 'Error loading average. Please refresh the page to try again.';
                echo $e;
            }

            echo '<tr><th><hr style="border-color:#6D7ACE; width:55%;"></th></tr>';
            echo "<tr><th><h3>Average Price: " . number_format($avgp) ."MP</h3>";
            echo "Based on <strong>" . mysqli_num_rows($pricehistory2) ."</strong> recorded prices.</th></tr>";
            echo '<tr><th><hr style="border-color:#6D7ACE; width:50%;"></th></tr>';
            echo "<tr><th><h2>Price History</h2></th></tr>";
            if(mysqli_num_rows($pricehistory)==0) {
            echo '<tr><th style="color: #E01200">This item has no recorded prices!</br>It must be quite the rare item...</th></tr>';
            }
            
            #PRINT PRICE HISTORY#
            while ($objph = mysqli_fetch_object($pricehistory)) {
                $dt = new DateTime($objph->Timestamp);
                echo "<tr><th style='font-size: 100%;'>Priced at <strong>" . number_format($objph->PlayerPrice) . "MP</strong> on " . $dt->format('M j Y H:i') . "</th></tr>";
            }
        echo '<tr><td style="height:30px"></td></tr>';
        #BACK BUTTON TEXT - BACK TO RESULTS#
        echo '<tr><td style="height:20px;"></br><a href="javascript:history.go(-1)">Back to Results</a></td></tr>';
        }
        if(isset($_GET["id"])) {
        echo '<tr><td style="height:20px;"></br><h3>Item ID:'. $iid  .'</h3></td></tr>';
        }
        
}
else {
    
        #STARTING HTML BEGIN#
?>    
			<html>
			<!-- Initalize Page -->
				<head>
					<title>Maralook - Item Search</title>
					<link rel="stylesheet" type="text/css" href="style.css">
				</head>
				<body>
					<div id="main">
					<?php echo file_get_contents('header.html') . "</br>"; ?>
					<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">
					<table align="center" width="710">
			<!-- End Init -->


        <tr><th><a href="item.php"><img src="img/search-item.png"></img></a></th></tr>
        <tr><th><img src="img/titles/item-search.png"></img></th></tr>
        <tr><td style="height:8px" ></td></tr>
        <tr><th>
        <p> <?php include_once 'vars.php'; 
			echo $item_desc; ?> 
		</p>
        </th></tr>
        <tr><td style="height:10px" ></td></tr>
        <tr><th>
        <form action="item.php" method="get">
        <strong>Search a Name:</strong> <input type="text" name="search">
        <input type="submit" value="Search">
        </form>
        
        <?php
        if(isset($_COOKIE['ml_user'])){
            $username = $_COOKIE['ml_user'];
            echo '<tr><th>You are searching as <strong>'. $username .'</strong>.</th></tr>';
        }
        echo '<tr><td style="height:26px" ></td></tr>';
        $pido = pcntl_fork();
    if ($pido == 0) {
        #echo "<tr><th><strong>NEW! <a class='reg' href='item.php?random'> Rando-matic Search!</a></strong><br><br></th></tr>";
        echo '<tr><th><h2>Recently Updated Items...</h2></th></tr>';
        
        $search_query = mysqli_query($con, "SELECT Names.ItemID, Names.ItemName iName, Pricelog.LogID FROM Names INNER JOIN Pricelog ON Names.ItemID = Pricelog.ItemID ORDER BY Pricelog.LogID DESC LIMIT 3");
        $search_nums = mysqli_num_rows($search_query);
        
        ?> 
        
        <tr><th><table align="center"><tr> 
        
        <?php
        while ($obj = mysqli_fetch_object($search_query)) {
            $iid = $obj->ItemID;
            echo "<td><a class='reg' href='item.php?info=" . urlencode($obj->iName) . "'>" . file_get_html("http://maralook.com/simplelisting.php?id=$iid") . "</a></td>";
        }

    } else {
    // this is the parent process, and we know the child process id is in $pid
    sleep(3); // wait 3 seconds
	echo '<tr><th><table align="center"><tr>'; 
    posix_kill($pido, SIGKILL); // then kill the child
    }
    
    echo '</tr></table></th></tr>';

    ##    
echo '<tr><td style="height:10px"><br>'.$var_item_updatetxt.'</td></tr>';    
}    
?>
<tr><td style="height:10px"></td></tr>
</table>
<img src="img/corner3.png" width="9" ><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner4.png" width="9"></div>
</body></html>

<?php
mysqli_close($con);
?>