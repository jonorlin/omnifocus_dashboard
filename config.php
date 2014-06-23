<?php
// you must set the location of the Omnifocus SQLite database file by replacing [username] with the user name of your user directory name on your Mac.

define("OMNIFOCUS_SQL_FILE", "/Users/[username]/Library/Caches/com.omnigroup.OmniFocus/OmniFocusDatabase2");

// you can change the name of your site here
define("SITE_NAME", "Omnifocus Dashboard");



// DON"T EDIT ANYTHING BELOW
// =========================
// initialize the MyDB class and create $db Object
include ("models/class_MYDB.php");

// initialize the View class and create $view Object
include ("views/class_View.php");
?>
