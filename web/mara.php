<?php
/* 
Requires the magic that can be found here: https://sourceforge.net/projects/simplehtmldom/
Throw that file in your main directory and this page (along with a few others) will start working.

Here's how this page works - 

For names and prices simply enter the start and end ID. 

Here's an example for names: mara.php?name&start=1&end=10
This will display the ID and name of the items with the ID 1-10.

Here's an example for prices: mara.php?price&start=1&end=10
This will display if the price gets updated or not. The price will not be visible.
You will also be told if there is no current price for the item, or if it is the same as the last entry.
Optionally, you can FORCE an entry for items. This will ignore the time requirement for a new entry. Just add &force
*/

//Include this stuff for connecting & crawling
require_once 'config.php';
require_once 'simple_html_dom.php';
require_once 'vars.php';
    
########################STARTING CONTENT#########################

$start = $_GET['start'];
$end = $_GET['end'];
$x=$start;

echo '<b>Marapets Name and Prices</b></br>';

//When using for getting names...    
if(isset($_GET['name'])){
    echo 'Getting names for IDs ' . $_GET['start'] . ' through ' . $_GET['end'] . '!</br></br>';
    echo "ItemID,ItemName,ItemSecondaryName,LastPrice<br>";
	while ($x<=$end){
		$html = file_get_html('https://www.marapets.com/pricechecker.php?id=' . $x . '&marasite=1');
		foreach($html->find('font["size+1"] b') as $name);
		
		//Some IDs got skipped. The ones that are not items are called - Price Checker -.
		//Below we just weed those out so they don't clutter our data.
		if($name->plaintext == "- Price Checker - "){
		}
		else{
			echo $x . "," . $name->plaintext . ",,0<br>";
		}
		$x++;
		usleep(2);
	}
}

//When using to get prices...
elseif(isset($_GET['price'])){
	
	##################CONNECTION INFO FOR DATABASE###################
	$con = new mysqli($ip,$user,$pw,$db);

	if ($con->connect_error) {
		echo "Failed to connect to MySQL: " . $con->connect_error;
	}
	###
	
    echo 'Setting prices for IDs ' . $_GET['start'] . ' through ' . $_GET['end'] . '!<br>';
	while ($x<=$end){
        $marapage = file_get_html('pricechecker.php?id=' . $x.'&small=1&marasite=1');
        
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
                elseif(($curtime-$time) >= $var_logging_cooldown AND $pprice != $curprice) {
                    $con->query($sql_logprice);
                    $con->query($sql_lastprice);
                    echo 'ID'.$x.' - Price Updated.</br>';
                }
                elseif($pprice = $curprice AND ($curtime-$time) >= $var_logging_cooldown) {
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