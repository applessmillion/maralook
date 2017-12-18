<html>
<?php
include_once('simple_html_dom.php');

    $start = $_GET['start'];
    $end = $_GET['end'];
    $x=$start;
    echo '<b>' . "Marapets Name and Prices" . "</b><br>";
    
if(isset($_GET['name'])){
    echo 'Getting names for IDs ' . $_GET['start'] . ' through ' . $_GET['end'] . '!<br><br>';
    echo "ItemID,ItemName,Category<br>";
while ($x<=$end){
    $html = file_get_html('http://www.marapets.com/pricechecker.php?id='.$x);
    foreach($html->find('font[size="+1"] b') as $element) 
       echo $x . ',' . $element->plaintext . ',000000000<br>';
    $x++;
    usleep(10);

}
}
elseif(isset($_GET['price'])){
    echo 'Getting prices for IDs ' . $_GET['start'] . ' through ' . $_GET['end'] . '!<br>';
    echo "ItemID,StaticPrice,PlayerPrice<br>";
while ($x<=$end){
    $html = file_get_html('http://www.marapets.com/pricechecker.php?id='.$x);
    foreach($html->find('a font[color="#264515"] i') as $sprice); 
    foreach($html->find('a font[color="#5F148D"]') as $pprice); 
       echo $x . ',' . preg_replace("/[^0-9.]/", "", substr($sprice->plaintext, 1)) . ',' . preg_replace("/[^0-9.]/", "", $pprice->plaintext) . '<br>';
    $x++;
    $sprice='';
    $pprice='';
    usleep(10);

}
}
?>
</html>