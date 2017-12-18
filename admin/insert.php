<html>
<?php
include_once 'config.php';

##################CONNECTION INFO FOR DATABASE###################
    $con = new mysqli($ip,$user,$pw,$db);
    if ($con->connect_error) {
        echo "Failed to connect to MySQL: " . $con->connect_error;
    }
    
########################STARTING CONTENT#########################

    echo '<b>' . "Maralook Admin - DB Insert" . "</b><br>";
    
if(isset($_GET['setid'])){
    if(isset($_GET['itemname'])){
        $iid = urldecode($_GET["setid"]);
        $iname = urldecode($_GET["itemname"]);
        $insertq = "INSERT INTO Names (ItemID, ItemName) VALUES ($iid, '$iname')";
        mysqli_query($con, $insertq);
        echo 'Row added successfully!</br>'. $iid . ',' . $iname .'</br>';
        }      
    }
}

?>
</html>