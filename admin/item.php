<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
include_once 'admin/config.php';
include_once 'vars.php';
include_once('simple_html_dom.php');

##################CONNECTION INFO FOR DATABASE###################
    $con = new mysqli($ip,$user,$pw,$db);
    if ($con->connect_error) {
        echo "Failed to connect to MySQL: " . $con->connect_error;
    }
    
########################STARTING CONTENT#########################


#CODE FOR SEARCHING DATABASE AND PRINTING RESULTS#
if(isset($_GET["name"])) {
    
        #STARTING HTML BEGIN#
        echo '<html><head>';
        echo '<title>Maralook Search</title>';
        echo '<link rel="stylesheet" type="text/css" href="style.css"></head>';
        echo '<body><div id="main">';
        echo file_get_contents('header.html') . "</br>";
        echo '<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">';
        echo '<table align="center" width="710">';
        #STARTING HTML END#
    
    $name = $_GET["name"];
    #GET NAME FROM SEARCH TERMS#
    $search_query = mysqli_query($con, "SELECT * FROM `Names` WHERE `ItemName` like '%$name%' ORDER BY ItemName ASC LIMIT 50");
    $search_nums = mysqli_num_rows($search_query);
    
    echo '<tr><th><img src="img/search-item.png"></img></th></tr>';
    echo '<tr><th><h2>Results for "'. $_GET["name"] . '"...</h2></th></tr>';
    echo '<tr><th><hr style="border-color:#6D7ACE; width:55%;"></th></tr>';
    while ($obj = mysqli_fetch_object($search_query)) {
        echo "<tr><th><a class='reg' href='?info=" . urlencode($obj->ItemName) . "'> " . $obj->ItemName . " </a><br /></th></tr>";
    }   
    echo '<tr><td style="height:20px;"><a href="javascript:history.go(-1)">Back to Search...</a></td></tr>';
}

#CODE FOR RETRIEVING DATA OF ITEM AND PRINTING RESULTS#
elseif(isset($_GET["info"])) {
    
        #STARTING HTML BEGIN#
        echo '<html><head>';
        echo '<title>Maralook Info - ' . urldecode($_GET["info"]) . '</title>';
        echo '<link rel="stylesheet" type="text/css" href="style.css"></head>';
        echo '<body><div id="main">';
        echo file_get_contents('header.html') . "</br>";
        echo '<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">';
        echo '<table align="center" width="710">';
        #STARTING HTML END#
    
        $info = urldecode($_GET["info"]);
        $search = mysqli_escape_string($con, $info);
        $query = mysqli_query($con, "SELECT * FROM Names WHERE ItemName='$info'");
        $obj = mysqli_fetch_object($query);
        $iid = $obj->ItemID;
        
        if($iid == NULL) {
        $marapage = '<h2 style="color:red;">Item Not Found!</h2></br>Please return to the search and try again.';
                #BACK BUTTON TEXT - BACK TO RESULTS#
        echo "<th>" . $marapage . "</br></br></th>"; 
        echo '<tr><td style="height:20px;"><a href="javascript:history.go(-1)">Back to Results</a></td></tr>';
        }
        else {
            $marapage = file_get_html('pricecopier.php?id=' . $iid);
            echo "<tr><th><h2>Displaying info for...</h2></th></tr>"; 
            echo '<tr><th>' . file_get_contents("pricecopier.php?id=$iid") . '</th></tr>';  
            echo '<tr><th><hr style="border-color:#6D7ACE; width:55%;"></th></tr>';
            echo '<tr><td style="height:10px"></td></tr>';
            echo "<tr><th><h2>Price History</h2></th></tr>";
        
            foreach($marapage->find('a font[color="#5F148D"]') as $pprice); 
            $pprice = preg_replace("/[^0-9.]/", "", $pprice->plaintext);
            
            $sqlcheck = "SELECT * FROM PricelogTEST WHERE ItemID=$iid ORDER BY Timestamp DESC LIMIT 1";
            $sql = "INSERT INTO PricelogTEST (ItemID, PlayerPrice) VALUES ($iid, $pprice);";       

            $row=mysqli_fetch_array(mysqli_query($con, $sqlcheck), MYSQL_ASSOC);
            $timest = $row['Timestamp'];
            $time = strtotime($timest);
            $curprice = $row['PlayerPrice'];
            $curtime = time();
            if(($curtime-$time) >= 19750 AND $pprice != $curprice) {
                $con->query($sql);
                echo '<tr><th style="font-size: 95%; color: #009900">Latest price added to history!</th></tr>';
            }
            elseif($pprice = $curprice AND ($curtime-$time) >= 19750) {
                echo '<tr><th style="font-size: 90%; color: #E59437">It seems the price has not changed since last checked!</th></tr>';
            }
            #PRINT PRICE HISTORY#
            $pricehistory = mysqli_query($con, "SELECT * FROM PricelogTEST WHERE ItemID=$iid ORDER BY Timestamp DESC LIMIT 15");
            $price_nums = mysqli_num_rows($pricehistory);
            while ($obj = mysqli_fetch_object($pricehistory)) {
                $dt = new DateTime($obj->Timestamp);
                echo "<tr><th style='font-size: 100%;'>Priced at " . number_format($obj->PlayerPrice) . "MP on " . $dt->format('M j Y g:i A') . "</th></tr>";
            }
                    echo '<tr><td style="height:30px"></td></tr>';
        
        #BACK BUTTON TEXT - BACK TO RESULTS#
        echo '<tr><td style="height:20px;"><a href="javascript:history.go(-1)">Back to Results</a></td></tr>';
        }
        
}
else {
    
        #STARTING HTML BEGIN#
        echo '<html><head>';
        echo '<title>Maralook - Item Search</title>';
        echo '<link rel="stylesheet" type="text/css" href="style.css"></head>';
        echo '<body><div id="main">';
        echo file_get_contents('header.html') . "</br>";
        echo '<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">';
        echo '<table align="center" width="710">';
        
        #STARTING HTML END#
        echo '<tr><th><img src="img/search-item.png"></img></th></tr>';
        echo '<tr><th><h2>Item Search</h2></th></tr>';
        echo '<tr><td style="height:8px" ></td></tr>';
        echo '<tr><th>';
        echo '<p>' , $item_desc , '</p>';
        echo '</th></tr>';
        echo '<tr><td style="height:10px" ></td></tr>';
        echo '<tr><th>';
        echo '<form action="item.php" method="get">';
        echo 'Item Search: <input type="text" name="name">';
        echo ' <input type="submit">';
        echo '</form>';
        echo '<tr><td style="height:26px" ></td></tr>';
        echo '<tr><th><h2>Recently Searched Item...</h2></th></tr>';
        
        $search_query = mysqli_query($con, "SELECT Names.ItemID, Names.ItemName iName, PricelogTEST.Timestamp FROM Names INNER JOIN PricelogTEST ON Names.ItemID = PricelogTEST.ItemID ORDER BY PricelogTEST.Timestamp DESC LIMIT 1");
        $search_nums = mysqli_num_rows($search_query);
        
        while ($obj = mysqli_fetch_object($search_query)) {
            $iid = $obj->ItemID;
            echo "<tr><td><a class='reg' href='item.php?info=" . urlencode($obj->iName) . "'>" . file_get_contents("simplelisting.php?id=$iid") . "</a></td></tr>";
        }

    ##        
}    

echo '<tr><td style="height:10px"></td></tr>';
echo '</table>';
echo '<img src="img/corner3.png" width="9" ><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner4.png" width="9"></div>';
echo '</body></html>';
?>