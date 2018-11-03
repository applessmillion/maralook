<?php
/*
This page is specifically used to display the items most recently
searched for on the items.php page. Shows only the images and names,
which are pulled by pricechecker.php with the recent items pulled
from our own lovely database.
Also will show a blank picture and the names of most recent items
if MP is for some reason down or cannot be reached.
*/

//This will be used later down the road for timing out.
$pido = pcntl_fork();
if ($pido == 0) {
	
	//Since our other option won't scan MP, we only need this here.
	require_once('simple_html_dom.php');

	//Grab the pricechecker page from Marapets.
	$html = file_get_html('https://www.marapets.com/pricechecker.php?id=' . $_GET["id"] . '&marasite=1');

	//Grab the picture and name from the page.
	foreach($html->find('img[border="0"]') as $picture); 
	foreach($html->find('font["size+1"] b') as $name); 

	//Finally, echo it all in HTML
	echo '<table align="center" width="100">';
	echo '<tr><td width="84"><img src="'. $picture->src . '"></td></tr>';
	echo '<tr><td><b style="font-size:8pt;color:darkblue">'.$name.'</b></br>';
	echo '</td></tr>';
	echo '</table>';
	
}

//So here's what happens if Marapets is unresponsive.
else{
	
    //This sleeps for 2 seconds. Once it wakes up, it's death to the above.
    sleep(2); // wait 2s
	
	//Since we won't be using Marapets here, connect to our nifty db!
	include_once 'config.php';
    
	//Connection info and stuff. 
	$con = new mysqli($ip,$user,$pw,$db);
	$info = $_GET["id"];
    $query = mysqli_query($con, "SELECT * FROM Names WHERE ItemID='$info'");
    $obj = mysqli_fetch_object($query);
    $itemname = $obj->ItemName;
	
	//Display a blank image and the name retrieved from our database.
	echo '<table align="center" width="100">';
	echo '<tr><td width="84"><img src="img/buffer.png"></td></tr>';
	echo '<tr><td><b style="font-size:8pt;color:darkblue">'.$itemname.'</b></br>';
	echo '</td></tr>';
	echo '</table>';
	
	//This is the knife to the if part of this if/else.
	posix_kill($pido, SIGKILL);
}
?>