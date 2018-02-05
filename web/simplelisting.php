<?php
    $pido = pcntl_fork();
    if ($pido == 0) {
include_once('simple_html_dom.php');

	#Grab the pricechecker page
	$html = file_get_html('http://www.marapets.com/pricechecker.php?id=' . $_GET["id"] . '&marasite=1');

	#Grab the details..
	foreach($html->find('img[border="0"]') as $picture); 
	foreach($html->find('font["size+1"] b') as $name); 

	#Finally, display it all in HTML
	echo '<table align="center" width="100">';
	echo '<tr><td width="84"><img src="'. $picture->src . '"></td></tr>';
	echo '<tr><td><b style="font-size:8pt;color:darkblue">'.$name.'</b></br>';
	echo '</td>';
	echo '</tr></table>';
	
} 
else{
    // this is the parent process, and we know the child process id is in $pid
    sleep(2); // wait 3 seconds
	include_once 'config.php';
	##################CONNECTION INFO FOR DATABASE###################
    
	$con = new mysqli($ip,$user,$pw,$db);
	$info = $_GET["id"];
    $query = mysqli_query($con, "SELECT * FROM Names WHERE ItemID='$info'");
    $obj = mysqli_fetch_object($query);
    $iin = $obj->ItemName;
	
	#Finally, display it all in HTML
	echo '<table align="center" width="100">';
	echo '<tr><td width="84"><img src="http://www.maralook.com/img/buffer.png"></td></tr>';
	echo '<tr><td><b style="font-size:8pt;color:darkblue">'.$iin.'</b></br>';
	echo '</td>';
	echo '</tr></table>';
	
	
	posix_kill($pido, SIGKILL); // then kill the child
}
?>