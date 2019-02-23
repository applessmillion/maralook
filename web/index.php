<?php
	require_once 'vars.php';
?>
<html>
	<head>
		<title>Maralook - Marapets Search</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="main">
			<?php
				echo    file_get_contents('header.html');
			?>
			<img src="img/corner.png" width="9"><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner2.png" width="9">
			<table align="center" width="710">
				<tr>
					<th>
						<h2>Welcome to Maralook</h2>
						</br>
					</th>
				</tr>
				<tr>
					<th>
						<img src="img/search-telescope.png" alt="marapets_search_telescope">
					</th>
				</tr>
				<tr>
					<th>
					</br>
						<p>
							<?php 
								echo $index_desc;
								echo $var_item_updatetxt;
							?>
						</p>
					</th>
				</tr>
			</table>
			<img src="img/corner3.png" width="9" ><img src="img/border.png" width="692" height="9" border="0"><img src="img/corner4.png" width="9">
		</div>
		</br></br>
	</body>
</html> 