<?php
/* This page is a funny page, probably shouldn't be used by
anyone that doesn't know how to properly use it. This is how
I update items in bulk. Could have easier ways, but this is 
what works for the time being. I won't comment on this or say
how it functions, as again, it probably shouldn't be used by 
anyone else.
*/

//Include this stuff for connecting & crawling
include_once 'config.php';
include_once('simple_html_dom.php');

##################CONNECTION INFO FOR DATABASE###################
$con = new mysqli($ip,$user,$pw,$db);

if ($con->connect_error) {
    echo "Failed to connect to MySQL: " . $con->connect_error;
}
    
########################STARTING CONTENT#########################

$start = $_GET['start'];
$end = $_GET['end'];
$x=$start;

echo '<b>Marapets Name and Prices</b></br>';

//When using for getting names...    
if(isset($_GET['name'])){
    echo 'Getting names for IDs ' . $_GET['start'] . ' through ' . $_GET['end'] . '!</br></br>';
    echo "ItemID,ItemName<br>";
	while ($x<=$end){
		$html = file_get_html('http://www.marapets.com/pricechecker.php?id='.$x.'&small=1&marasite=1');
		foreach($html->find('font[size="+1"] b') as $element) 
		echo $x . "," . $element->plaintext . ",,0<br>";
		$x++;
		usleep(2);
	}
}

//When using to get prices...
elseif(isset($_GET['price'])){
    echo 'Setting prices for IDs ' . $_GET['start'] . ' through ' . $_GET['end'] . '!<br>';
	while ($x<=$end){
        $marapage = file_get_html('http://www.marapets.com/pricechecker.php?id=' . $x.'&small=1&marasite=1');
        
		foreach($marapage->find('a font[color="#5F148D"]') as $pprice); 
        $pprice = preg_replace("/[^0-9.]/", "", $pprice->plaintext);
                
        $sql_logprice = "INSERT INTO Pricelog (ItemID, PlayerPrice) VALUES ('$x', '$pprice');";
        $sql_lastprice = "UPDATE Names SET LastPrice='$pprice' WHERE ItemID=$x";
        $sqlcheck = "SELECT * FROM Pricelog WHERE ItemID='$x' ORDER BY Timestamp DESC LIMIT 1;";
        $row=mysqli_fetch_array(mysqli_query($con, $sqlcheck), MYSQL_ASSOC);
                
        $timest = $row['Timestamp'];
        $time = strtotime($timest);
                
		$curprice = $row['PlayerPrice'];
        $curtime = time();
		
        if(isset($_GET['force']))
                {
                    $con->query($sql_logprice);
                    $con->query($sql_lastprice);
                    echo 'ID'.$x.' - Price FORCIBLY Updated.</br>';
                }
                elseif(($curtime-$time) >= 20250 AND $pprice != $curprice) {
                    $con->query($sql_logprice);
                    $con->query($sql_lastprice);
                    echo 'ID'.$x.' - Price Updated.</br>';
                }
                elseif($pprice = $curprice AND ($curtime-$time) >= 20250) {
                    echo 'ID'.$x.' - No Change in price.</br>';
                }                
		$x++;
		$pprice='';
		usleep(2);
	}
}

//When nothing is defined...
else{
echo "Error. Missing variables. Perhaps you visited this page by mistake?";
}

?>