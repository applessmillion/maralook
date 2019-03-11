<?php
/* File for editing text and variables for most of the pages on the site.
   To edit database values, check out config.php. */
#########################
#   USEFUL VARIABLES    #
#########################
$mainpage_notice = "";
$contact_email = "email@example.com";
$link_github = "https://github.com/applessmillion/maralook";
$copyright_notice = "Copyright <a class='head' href='http://www.marapets.com'>www.MaraPets.com</a> All Rights Reserved. Used With Permission.";
$text_general_credit =  "A Marapets community project. Originally maintained by Mexatox.";
$cookie_notice = "By using Maralook.com, you acknowledge that we use cookies to customize your experience.";

#Time until an item can get an update to it's current price.
$var_logging_cooldown = 29000;

$text_recentnews_first_date = "October 31, 2018";
$text_recentnews_first_text = "Example news. Check out the news below for a <strong>real</strong> entry.";
$text_recentnews_second_date = "April 26th";
$text_recentnews_second_text = "Item database has been updated to the new Newth Racing Prizes. Check <a class='head' href='http://www.marapets.com/wishlist.php?do=newest&page=0'>the wishlist</a> for Marapet's newest items.";

### Variables for the elemets on each webpage
	$webpage_contenttable_width = 800; 								 	//table width
	$webpage_contentborder_width = ($webpage_contenttable_width-18); 	//border width
	$webpage_border_color = "#6D7ACE";									//line break color
	$webpage_border_length = "65%";	   									//line break width
	$webpage_device_iframe_height = 460;								//iframe height. Used on search for iteminfo.php
	$webpage_maincontent_css = "max-width:1300px;";						//100% size for alert, 80% of main content max size.
	$webpage_table_text_labelcolor = "blue";
	$webpage_head_image_css = 'width="28%" style="min-width:196px;max-width:384px;"';
	$table_tagcol_text_size = 20;
	$widget_webpage_border = "<hr style='border-color:$webpage_border_color; width:70%;'>";

#########################
# ERROR PAGE VARIABLES  #
#########################
$error404_page_title = "Maralook - Internal Server Error (500)";
$error404_page_headtext = "Error - Internal Server Error";
$error404_page_description = "<center>The page you're looking for couldn't be found. Try <a href='../'>returning home</a>. If you think this is an error, feel free to contact us at ".$contact_email.".</center>";
$error500_page_title = "Maralook - Page Not Found ";
$error500_page_headtext = "Error - Page Not Found";
$error500_page_description = "<center>Looks like our server is having some trouble. Try refreshing, and if the problem persists, feel free to contact us at ".$contact_email.".</center>";

#########################
#  WEBPAGE TEXT BLOCKS  #
#########################

#Multiple Pages - Recent News
$var_item_updatetxt = 
"
<h3>Recent News</h3>
<p><strong>$text_recentnews_first_date</strong> - $text_recentnews_first_text</a></p>
<p><strong>$text_recentnews_second_date</strong> - $text_recentnews_second_text</p>
</br>
";

#Item - Main Description
$text_page_item_desc = 
"
Search by an item's name below! It can be a full name, half of a name, or even a few random letters.
If your search is very broad, you'll get up to 50 results starting with the best matches.
";

#Price - Main Description
$text_page_price_desc = 
"
Search for a price range below! You can search for any price between 0MP and 500,000MP.
If you'd like to narrow the results down even further, you can also enter an item's name or part of it's name.
If your search is too broad, you'll be shown up to 50 results starting with the lowest priced matches.
";

#Index - Main Description (kinda a combo of above)
$text_page_index_desc = 
"
<h3>Item Search</h3>
<p>The <strong>Item Search</strong> allows you to search a Marapets item to find any 
collected pricing history. Records are generated upon user lookup, so if an item does not have any history, 
it may mean the item is not searched for often or it does not appear in the Shop Search often.</p>
</br>
<h3>Price Search</h3>
<p>The <strong>Price Search</strong> allows you to search a price range. Just put in a minimum and maximum and Maralook will
report the items that fall in that range. From the search page, you will be able to purchase the item from the Shop Search, 
or view it on Maralook first. Price is determined on the last time the item was looked up, so actual pricing may vary.
</p>
</br>
<h3>Wanted!</h3>
<p>The <strong>Wanted!</strong> page shows you all the items we seem to be lacking data for! This could happen when there's an item
that almost never does on the shop search, or if it's a brand new item. Most of the time, unless it is a very rare item, we'll collect
data for the item, but just in case we don't, you'll be able to find the hard to find items here!
</p>
</br>
";

#Users - user page description
$text_page_users_desc = 
"
<p>Looking to become recognized as a <strong>Maralook Contributor</strong>? Now you can! Simply input your
desired name into the box below. Upon submitting your username, you'll be searching and logging prices as that username!
The number of successful price additions will be logged to your name. If you manage to grab a lot of new prices,
you might even make it on the leaderboards! Maralook reserves the right to remove any names from our leaderboard that may not
 be suitable for some people. So please don't put in a name that we might have to remove.</p>
<hr style='border-color:$webpage_border_color; width:$webpage_border_length;'>
</br>
";

#About - Main Descritpion
$text_page_about_desc = "
<h3>What is Maralook?</h3>
Maralook is a tool for new and experienced players to find pricing information on Marapets items. 
Using our site, you can look up recent and record prices of any items we've managed to find data on.
You can search by price, name, or even by items that we currently don't have any data on.
We'll display up to 15 most-recent prices we've found on an item, along with record high, low, and average prices, and recent averages.
We're a great tool for finding information about hard to get items, or even finding cheap items for whatever you need!
";
$text_page_about_contact = "
</br>
Need to contact us about anything? Send an email to <b>$contact_email</b>.</br>
Maralook's source code is also available. <a class='head' href='$link_github'>Find us on GitHub</a>.
";

#########################
#    TECH VARIABLES     #
#########################
### Imports the few lines required for Bootstrap. 
$tech_css_js_styleimports = '
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>';
$webpage_background = "img/bg.png";
$tech_html_head_start_body = $tech_css_js_styleimports . '<body style="background:url('.$webpage_background.') no-repeat;background-size:cover;line-height:1;background-attachment:fixed;text-align:center;height:100%">';
### Content boxes that are used on almost every page. Sets up the layout for the main content.
	$webpage_topcontentbox = 
		'<div class="card" style="margin: 0 auto;max-width:80%">
			<table align="center" width="$webpage_contenttable_width" style="background-color:white" class="table table-borderless">
				<tbody>';
				
	$webpage_bottomcontentbox = 
		'		</tbody>
			</table>
		</div>
		</br>';

#########################
# DEPRECATED VARIABLES  #
#########################
$statuser = file_get_contents("stats.php?total-users");
$statlog = 	file_get_contents("stats.php?total-logs&format");
$about_madeby =  "Deprecated. Use text_general_credit";
?>