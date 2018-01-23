<?php
include_once('simple_html_dom.php');
#Grab the pricechecker page

if(isset($_GET['id'])){
$html = file_get_html('http://www.marapets.com/pricechecker.php?id=' . $_GET["id"] . '&marasite=1');

#Grab the details..
foreach($html->find('img[border="0"]') as $picture); 
foreach($html->find('font["size+1"] b') as $name); 
foreach($html->find('i') as $shop); 
foreach($html->find('font[color="#C53F55"]') as $rarity); 
$rarityno = preg_replace("/[^0-9.]/", "", $rarity->plaintext);
foreach($html->find('font[color="#0000FF"]') as $want); 
$wantno = preg_replace("/[^0-9.]/", "", $want->plaintext);
foreach($html->find('a font[color="#5F148D"]') as $playershop); 


#Finally, display it all in HTML
echo '<table align="center" width="510">';
echo '<tr><td width="85"><img src="'. $picture->src . '"></td></tr>';
echo '<tr><td width="250"><b style="line-height:1.15; font-size:14pt">' , $name , '</b></br>';
echo '<b style="color: darkorange;">Rarity ' , $rarityno , ' </b>';
echo '<b style="color: darkblue;"><a href="http://www.marapets.com/wanted.php?do=browse&id=', $_GET["id"] , '" style="font-size:100%;">' , $wantno , ' Wanted', '</a></b></br>' , $shop , '</i></br>'; 
echo '<a target="_blank" href="http://www.marapets.com/shopsearch.php?do=' , $name->plaintext , '" style="font-size:100%;">', $playershop , '</a></br>';
echo '</td>';
echo '</tr></table>';
}
else{
echo "Missing vars!";
}
?>