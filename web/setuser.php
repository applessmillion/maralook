<?php
include_once 'config.php';

##################CONNECTION INFO FOR DATABASE###################
    $con = new mysqli($ip,$user,$pw,$db);
    if ($con->connect_error) {
        echo "Failed to connect to MySQL: " . $con->connect_error;
    }
    
########################STARTING CONTENT#########################

if(isset($_GET["username"])){
    $cookieuser = $_GET["username"];
    $cookiename = 'ml_user';
    setcookie($cookiename, $cookieuser, time() + (86400 * 365), "/");
    $plookup = mysqli_query($con, "SELECT * FROM Userboard WHERE Username='$cookieuser' LIMIT 1");
    $padd = "INSERT INTO Userboard (Username) VALUES ('$cookieuser');";
    if(mysqli_num_rows($plookup)==0) {
        $con->query($padd);
    }
}

elseif(isset($_GET["report"])){
    $cookieuser = $_COOKIE[$cookiename];
    $cookiename = 'ml_user';
    if(!isset($_COOKIE[$cookiename])) {
        echo "Cookie named '" . $cookiename . "' is not set!";
    } 
    else {
    echo "Cookie '" . $cookiename . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookiename];
        $plookup = mysqli_query($con, "SELECT * FROM Userboard WHERE Username='$cookieuser' LIMIT 1");
    $padd = "INSERT INTO Userboard (Username, Contributions) VALUES ('$cookieuser', '0');";
    if(mysqli_num_rows($plookup)==0) {
        $con->query($padd);
    }
    echo "</br>";
    echo $cookieuser , " , " , mysqli_num_rows($plookup);
    }
    
}
else{
$cookieuser = $_COOKIE[$cookiename];
$cookiename = 'ml_user';    
}
?>
