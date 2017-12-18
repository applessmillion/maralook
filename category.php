<?php
#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
include_once 'config.php';
include_once('simple_html_dom.php');

##################CONNECTION INFO FOR DATABASE###################
    $con = new mysqli($ip,$user,$pw,$db);
    if ($con->connect_error) {
        echo "Failed to connect to MySQL: " . $con->connect_error;
    }
    
########################STARTING CONTENT#########################

#CODE FOR RETRIEVING DATA OF ITEM AND PRINTING RESULTS#
if(isset($_GET["cat"])) {
    
        #STARTING HTML BEGIN#
        echo '<html><head>';
        echo '<title>Maralook Category Search</title>';
        echo '<link rel="stylesheet" type="text/css" href="style.css"></head>';
        echo '<body><div id="main">';
        echo file_get_contents('header.html') . "</br>";
        echo '<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">';
        echo '<table align="center" width="710">';
        #STARTING HTML END#
    
    $name = $_GET["cat"];
    if(isset($_GET["page"])) {  
        $page = 8*($_GET["page"]);
    }
    else {
        $page = 8;
    }
    
    #GET NAME FROM SEARCH TERMS#
    $pg1 = $page-8;
    $search_query = mysqli_query($con, "SELECT * FROM `Names` WHERE `Category` = '$name' ORDER BY ItemName ASC LIMIT $pg1, 4");
    $search_nums = mysqli_num_rows($search_query);
    echo '<tr><th><img src="img/cat/'.$name.'.png"></img></th></tr>';
    echo '<tr><th><h2>Results for Category...</h2></th></tr>';
    echo '<tr><th><hr style="border-color:#6D7ACE; width:55%;"></th></tr>';
    echo '<tr><th><table align="center"><tr><th>';
    while ($obj = mysqli_fetch_object($search_query)) {
        $iid = $obj->ItemID;
        ##echo "<tr><th><a class='reg' href='item.php?info=" . urlencode($obj->ItemName) . "'> " . $obj->ItemName . " </a><br /></th></tr>";
        echo "<th><a class='reg' href='item.php?info=" . urlencode($obj->ItemName) . "'> " . file_get_contents("http://www.maralook.com/categorylisting.php/categorylisting.php?id=$iid") . " </a></td>";

    }
    echo '</th></tr><tr><th>';
    $pg1 = $page-4;
    $search_query2 = mysqli_query($con, "SELECT * FROM `Names` WHERE `Category` = '$name' ORDER BY ItemName ASC LIMIT $pg1, 4");
    $search_nums2 = mysqli_num_rows($search_query2);
    while ($obj = mysqli_fetch_object($search_query2)) {
        $iid = $obj->ItemID;
        ##echo "<tr><th><a class='reg' href='item.php?info=" . urlencode($obj->ItemName) . "'> " . $obj->ItemName . " </a><br /></th></tr>";
        echo "<th><a class='reg' href='item.php?info=" . urlencode($obj->ItemName) . "'> " . file_get_contents("http://www.maralook.com/categorylisting.php/categorylisting.php?id=$iid") . " </a></td>";

    }    
    
    echo '</table></th></tr>';
    if($search_nums2 >= 4)
    {
        echo '<tr><td style="height:8px;"><a href="?cat='. $name .'&page='. (($page/8)+1) .'">Next Page</a></td></tr>';
    }
    if($page > 0 and $page > 8)
    {
        echo '<tr><td style="height:8px;"><a href="?cat='. $name .'&page='. (($page/8)-1) .'">Previous Page</a></td></tr>';
    }
    
    echo '<tr><td style="height:45px;"><a href="category.php">Back to Search...</a></td></tr>';    
}

#CODE FOR SEARCHING DATABASE AND PRINTING RESULTS#
else{
    
    #STARTING HTML BEGIN#
    echo '<html><head>';
    echo '<title>Maralook Item Categories</title>';
    echo '<link rel="stylesheet" type="text/css" href="style.css"></head>';
    echo '<body><div id="main">';
    
    echo file_get_contents('header.html') . "<br>";
    echo '<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">';
    echo '<table align="center" width="710">';
    #STARTING HTML END#
    
    echo '<table align="center" width="710">';
    echo '<tr><th>' . file_get_contents('categorylisting.html') . '</th></tr>';  
}

echo '<tr><td style="height:10px"></td></tr>';
echo '</table>';
echo '<img src="img/corner3.png" width="9" ><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner4.png" width="9"></div>';
echo '</body></html>';
?>