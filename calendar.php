<?php
include ('config.php');
$page_title = 'Calendar';

if (!isset($_GET["month"])) $_GET["month"] = date("n");
if (!isset($_GET["year"]))  $_GET["year"]  = date("Y");
if (!isset($_GET["type"])) $_GET['type'] = "dateDue";

$cMonth = $_GET["month"];
$cYear  = $_GET["year"];
$type   = $_GET["type"];

$monthNames = Array("January", "February", "March", "April", "May", "June", "July",
"August", "September", "October", "November", "December");

$next_month = getDate(mktime(0,0,0,$cMonth+1,1,$cYear));
$next_month_text = $next_month["month"];

$prev_month = getDate(mktime(0,0,0,$cMonth-1,1,$cYear));
$prev_month_text = $prev_month["month"];

$next_year = getDate(mktime(0,0,0,$cMonth,1,$cYear+1));
$next_year_text = $cYear+1;

$prev_year = getDate(mktime(0,0,0,$cMonth,1,$cYear-1));
$prev_year_text = $cYear-1;

$today_timestamp = mktime(0,0,0,date("n"),date("d"),date("Y"));  // 1st day of display month
$today_month = date('m',$today_timestamp);

$timestamp = mktime(0,0,0,$cMonth,1,$cYear);  // 1st day of display month
$maxday = date("t",$timestamp);  // total days in month

$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];  //  0 is Sunday thru 6 is Saturday

$lastday_timestamp = getdate(mktime(0,0,0,$cMonth,$maxday,$cYear) );
$lastday = $lastday_timestamp['wday'];  //  0 is Sunday thru 6 is Saturday

$days_before_month_to_show =  ( $startday == 0 ? 6 : $startday - 1 );

$firstymd = date('Y-m-d',mktime(0,0,0,$cMonth,1-$days_before_month_to_show,$cYear) );

$mapping = array(0,6,5,4,3,2,1); // maps days to show based on last day of month
$days_after_month_to_show  = $mapping[$lastday];

$lastymd = date('Y-m-d',mktime(0,0,0,$cMonth,$maxday+$days_after_month_to_show,$cYear) );

$total_days_to_display = $days_before_month_to_show + $maxday + $days_after_month_to_show;

$ret = $db->get_tasks_in_date_range($firstymd,$lastymd,$type);

include ('views/header.php');
include ('views/calendar.php');
include ('views/footer.php');
?>
