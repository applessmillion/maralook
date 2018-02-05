<?php
##########Technical Vars############
	
$statuser = file_get_contents("http://www.maralook.com/stats.php?total-users");
$statlog = 	file_get_contents("http://www.maralook.com/stats.php?total-logs");
######################

#For important announcements
$mainpage_notice = "";
#########################

#For news on main pages
$var_item_updatetxt = 
"
". $mainpage_notice ."
<h3>Recent News</h3>
<p><strong>February 5th</strong> - Item database has been updated to the Heartless box. Check <a class='head' href='http://www.marapets.com/wishlist.php?do=newest&page=0'>the wishlist</a> for everything new.</p>
</br>
";
#
$about_desc = 
"
<h4>Mara Stats</h4><br>
<hr style='border-color:#6D7ACE; width:50%;'>
There have been <b>". $statuser ."</b> Users contributing to our website!
</br>
Maralook has logged <b>". $statlog ."</b> different prices on Marapets items!
</br>
Maralook is a tool for new and experienced players to find useful 
pricing information. Maralook allows anyone to look up information on price history and list items by price.
</br></br>
Need to contact us about anything? Send an email to <b>maralook@jadefury.com</b> and we'll get back to you as soon as possible!

";

$about_madeby = 
"</br></br>Designed & programmed by Mexatox</br>
Maintained by Mexatox and the Marapets community
";

$about_use = 
"Marapets assets & stuff used With permission.<br>
Copyright 2004-2017 Marapets.com All Rights Reserved.<br>
By using Maralook.com, you acknowledge that we use cookies to better your experience.";

$item_desc = 
"Type what you're searching for below! If your search is too broad, you'll be given up to
50 results to select from.";

$price_desc = 
"Price search allows you to search for items within the range you specify. Enter a minimum price and maximum price and you'll find up to 50 results in that range!";

$index_desc = 
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
";

$var_users_desc = 
"
". $mainpage_notice ."
<p>Looking to become recognized as a <strong>Maralook Contributor</strong>? Now you can! Simply input your
desired name into the box below. Upon submitting this name, you'll be searching and logging prices as that name!
The number of successful price additions will be logged to your name in the scoreboard below. Maralook reserves the right
to remove any names from our leaderboard that may not be suitable for some people.</p>
</br>
";


?>