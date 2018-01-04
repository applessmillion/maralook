<?php
include_once 'vars.php';
?>
<html>
	<head>
		<title>Maralook - Changes</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="main">
		<?php
		echo file_get_contents('header.html');
		?>
		</br>
		<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">
		<table align="center" width="710">
		<tr>
			<th>
				<h2>Maralook Changelog</h2>
			</th>
		</tr>
		<tr>
			<th>
				<p>Hi.
				<br>
				This page isn't maintained anymore. Check up on the latest news on our main page. You'll be able to find any special updates and new stuff there. If you've been
				gone for a long long time, just click around to find new things!
				</p>
			</th>
		</tr>
		<?php
		echo '<tr><th style="font-size: 85%;"></br></br>'.$about_madeby.'</br>'.$about_use.'</th></tr>';
		?>
		</table>
		<img src="img/corner3.png" width="9" ><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner4.png" width="9">
		</div>
</html> 
