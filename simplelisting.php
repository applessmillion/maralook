<?php
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

?>