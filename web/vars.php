<?php
##########Technical Vars############
$statuser = file_get_contents("http://www.maralook.com/stats.php?total-users");
$statlog = 	file_get_contents("http://www.maralook.com/stats.php?total-logs&format");

#For important announcements
$mainpage_notice = "";

#########################

#Multiple Pages - Recent News
$var_item_updatetxt = 
"
<h3>Recent News</h3>
<p><strong>April 29th</strong> - Improved site performance! You should now notice faster loading times.</a></p></br>
<p><strong>April 26th</strong> - Item database has been updated to the new Newth Racing Prizes. Check <a class='head' href='http://www.marapets.com/wishlist.php?do=newest&page=0'>the wishlist</a> for Marapet's newest items.</p>
</br>
";

#About - Main Descritpion
$about_desc = 
"
<h3>Mara Stats</h3>
<hr style='border-color:#6D7ACE; width:50%;'>
There have been <b>$statuser</b> Users contributing to our website!
</br>
Maralook has logged <b>$statlog</b> prices on Marapets items!
</br></br></br>
<h3>What is Maralook?</h3>
<hr style='border-color:#6D7ACE; width:50%;'>
Maralook is a tool for new and experienced players to find pricing information on Marapets items. 
Using our site, you can look up recent and record prices of any items we've managed to find data on.
You can search by price, name, or even by items that we currently don't have any data on.
We'll display up to 15 most-recent prices we've found on an item, along with record high, low, and average prices, and recent averages.
We're a great tool for finding information about hard to get items, or even finding cheap items for whatever you need!
</br></br><br>
Need to contact us about anything? Send an email to <b>maralook@jadefury.com</b> and we'll get back to you as soon as possible!</br></br>
Our source code is also now on GitHub! <a class='head' href='https://github.com/applessmillion/maralook'>Find us on GitHub</a>.</br>
";

#About - Madeby bottom page
$about_madeby = 
"</br></br>Designed & programmed by Mexatox</br>
Maintained by Mexatox and the Marapets community</br>
";

#About - Needed stuff at bottom page
$about_use = 
"Marapets assets & stuff used With permission.</br>
Copyright 2004-2018 <a href='www.marapets.com?ref=maralook'>Marapets.com</a> All Rights Reserved.</br>
Website maintained by <a href='www.jadefury.com'>Jadefury</a>.</br>
By using Maralook.com, you acknowledge that we use cookies to better your experience.";

#Item - Main Description
$item_desc = 
"Search by an item's name below! It can be a full name, half of a name, or even a few random letters.
If your search is very broad, you'll get up to 50 results starting with the best matches.";

#Price - Main Description
$price_desc = 
"
Search for a price range below! You can search for any price between 0MP and 500,000MP.
If you'd like to narrow the results down even further, you can also enter an item's name or part of it's name.
If your search is too broad, you'll be shown up to 50 results starting with the lowest priced matches.
";

#Index - Main Description (kinda a combo of above)
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
<h3>Wanted!</h3>
<p>The <strong>Wanted!</strong> page shows you all the items we seem to be lacking data for! This could happen when there's an item
that almost never does on the shop search, or if it's a brand new item. Most of the time, unless it is a very rare item, we'll collect
data for the item, but just in case we don't, you'll be able to find the hard to find items here!
</p>
</br>
";

#Users - user page description
$var_users_desc = 
"
<p>Looking to become recognized as a <strong>Maralook Contributor</strong>? Now you can! Simply input your
desired name into the box below. Upon submitting your username, you'll be searching and logging prices as that username!
The number of successful price additions will be logged to your name. If you manage to grab a lot of new prices,
you might even make it on the leaderboards! Maralook reserves the right to remove any names from our leaderboard that may not
 be suitable for some people. So please don't put in a name that we might have to remove.</p>
</br>
";
?>