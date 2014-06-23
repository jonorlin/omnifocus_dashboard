# README #

#omnifocus-dashboard#

A php-based tool to view Omnifocus in a local browser with better dashboard views.

### Requirements ###

* Local web server that support  php and SQLite.  I use [MAMP](http://www.mamp.info/en/) but you could use the Apple's pre-installed web server.
* [Omnifocus](https://www.omnigroup.com/omnifocus) I'm using Version 1, but it should work with Version 2.

### Home Page Screenshot ###
![Screenshot](http://www.orlinmedia.com/images/Omnifocus_Dashboard.jpeg)

### Features ###

* Home page view with due, starting and no date actions
* On home page, actions in on hold contexts are listed under orange heading and in italics in the Context list.
* View lists by open actions, start dates, due dates, and actions with no dates.
* Click on a table column name to sort by that field
* Click on an action to open it in Omnifocus
* Counts task in In Box, Open, By Start Dates, By Due Dates and Completed Task
* View Folders, Contexts, Projects


### How It Works ###

Omnifocus stores your data in multiple zipped XML files for quick synchronization at:
> /Users/[username]/Library/Application Support/OmniFocus/OmniFocus.ofocus.

But it also stores a cache on your data in a SQLite database at:
> /Users/[username]/Library/Caches/com.omnigroup.OmniFocus/OmniFocusDatabase2

This script reads the SQLite database and displays it on a local web browser.

If Omnifocus changes its sqlite database structure, it could break this script.

### Code Libraries Used ###

* php
* SQLite
* jquery
* Bootstrap CSS
* Tablesorter JS

### Future Features ###
* This version doesn't fully support project and context hierarchy.  So viewing the top level project doesn't include sub-projects.  Top level contexts show 1 level deep contexts on the context list pages.

### Configuration ###

* Download the repository
* Place the folder in your web server htdocs directory
* Configure the settings in /config.php to set the correct SQLite database path and site name

### Questions or Comments ###

* Add questions or comments to the Github issue tracker or email jon at jonorlin.com.
