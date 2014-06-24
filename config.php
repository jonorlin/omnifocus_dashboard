<?php
// Edit the following 3 settings to configure your installation

// you must set the location of the Omnifocus SQLite database file by replacing [username] with the user name of your user directory name on your Mac.

define("OMNIFOCUS_SQL_FILE", "/Users/[username]/Library/Caches/com.omnigroup.OmniFocus/OmniFocusDatabase2");

// you can change the name of your site here
define("SITE_NAME", "Omnifocus Dashboard");

// for calculating the correct dates, set the timezone zone.
// for US Pacific Time, use America/Los_Angeles
// for US Eastern Time, use America/New_York
// for others, see http://www.php.net//manual/en/timezones.php
date_default_timezone_set('America/Los_Angeles');


// DON"T EDIT ANYTHING BELOW
// =========================
// initialize the MyDB class and create $db Object
include ("models/class_MYDB.php");

// initialize the View class and create $view Object
include ("views/class_View.php");
?>
