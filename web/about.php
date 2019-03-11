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
						<img src="img/about-image.png" alt="About" <?php echo $webpage_head_image_css; ?>>
						<h1>About Maralook</h1>
						<?php echo $widget_webpage_border; ?>
					</div>
					<div class="mx-3 text-left">
						<p><?php echo $text_page_about_desc;?></p>
						<p class="text-right"><?php echo $text_page_about_contact; ?></p>
					</div>
					<div class="text-center" style="font-size: 85%;">
						<?php echo $text_general_credit.'</br>'.$cookie_notice; ?>
					</div>
				</td>
			</tr>
			<?php echo $webpage_bottomcontentbox; ?>
		</div>
	</body>
</html> 