<?php
require_once 'vars.php';
?>
<!DOCTYPE html>
	<head>
		<title>Maralook - Marapets Search</title>
	</head>
	<?php echo $tech_html_head_start_body; ?>
		<div>
			<?php echo file_get_contents("gtag.html");
				echo file_get_contents("header-new.html");
			?>
			</br>
		</div>
		<div class="container-fluid" style="<?php echo $webpage_maincontent_css; ?>">
			<?php 
				if($alert_text != ""){ echo $widget_webpage_alert;}
				echo $webpage_topcontentbox;
			?>
			<tr>
				<td>
					<div class="text-center">
						<img src="img/search-telescope.png" alt="Telescope" <?php echo $webpage_head_image_css; ?>>
						<h2>Welcome to Maralook</h2>
						<?php echo $widget_webpage_border; ?>
					</div>
					<p class="mx-5">
						<?php echo $text_page_index_desc; ?>
					</p>
					<div class="text-center">
						<p style="font-size:75%;"><?php echo $text_general_credit; ?></p> 
					</div>
				</td>
			</tr>
			<?php echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
</html> 