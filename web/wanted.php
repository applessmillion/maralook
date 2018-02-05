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
        #STARTING HTML BEGIN#
        echo '<html><head>';
        echo '<title>Maralook Search</title>';
        echo '<link rel="stylesheet" type="text/css" href="style.css"></head>';
        echo '<body><div id="main">';
        echo file_get_contents('header.html') . "</br>";
        echo '<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">';
        echo '<table align="center" width="710">';
        #STARTING HTML END#
    
    #GET NAME FROM SEARCH TERMS#
    $search_query = mysqli_query($con, "SELECT * FROM Names WHERE LastPrice='0' ORDER BY ItemID ASC LIMIT 800");
    $search_nums = mysqli_num_rows($search_query);
    
    echo '<tr><th><a href="price.php"><img src="img/search-price.png"></a></th></tr>';
    
    if($search_nums > 0)
    {
    echo '<tr><th><h2>Found '. $search_nums .' Items Wanted!</h2></th></tr>';
	echo '<tr><th><h3>Click on an item to see if it is currently listed!</h3></th></tr>';
    echo '<tr><th><hr style="border-color:#6D7ACE; width:55%;"></th></tr>';
    while ($obj = mysqli_fetch_object($search_query)) {
        echo "<tr><th><a class='reg' href='item.php?info=" . urlencode($obj->ItemName) . "'><strong>" . $obj->ItemName,"</a></strong>";
        if($obj->SecondaryName != NULL)
        {
           echo "  (" . $obj->SecondaryName . ") </a><br /></th></tr>";
        }
        
    }
	}

echo '<tr><td style="height:10px"></td></tr>';
echo '</table>';
echo '<img src="img/corner3.png" width="9" ><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner4.png" width="9"></div>';
echo '</body></html>';
?>