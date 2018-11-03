<?php
include_once '../vars.php';
?>
<html>
	<head>
		<title><?php echo $error404_page_title; ?></title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="main">
		<br>
		<img src="./img/corner.png" width="9"><img src="./img/border.png" width="692" height="9" border="0"><img src="./img/corner2.png" width="9">
		<table align="center" width="710">
			<tr>
				<th>
					<h1>
						<?php echo $error404_page_headtext; ?>
					</h1>
					<br>
				</th>
			</tr>
			<tr>
				<th>
					<img src="./img/error.png" width="250" height="250">
				</th>
			</tr>
			<tr>
				<th>
					<p>
					<?php echo $error404_page_description; ?>
					</p>
				</th>
			</tr>
		</table>
		<img src="./img/corner3.png" width="9" ><img src="./img/border.png" width="692" height="9" border="0"><img src="./img/corner4.png" width="9">
		</div>
		</br></br>
	</body>
</html> 