<?php
include_once 'vars.php';

echo '<html>';
echo '<head><title>Maralook - Changes</title><link rel="stylesheet" type="text/css" href="style.css"></head>';
echo '<body><div class="main">';
echo file_get_contents('header.html') . "</br>";

echo    '<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">';
echo    '<table align="center" width="710">';
echo        '<tr><th><h2>Maralook Changelog</h2></th></tr>';
echo        '<tr><th><p>';
echo        include_once 'changelog.html';
echo        '</p></th></tr>';
echo        '<tr><th style="font-size: 85%;"></br></br>'.$about_madeby.'</br>'.$about_use.'</th></tr>';
echo    '</table>';

echo    '<img src="img/corner3.png" width="9" ><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner4.png" width="9">';

echo '</div>';
echo '</html>'; 
?>