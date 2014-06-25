<?php
include ('config.php');
$page_title = 'Stats';

$ret = $db->get_stats();

$row_names = array(
  '0' => array ( "name" => 'Year Month', "width" => "4"),
  '1' => array ( "name" => 'Date Added', "width" => "1"),
  '2' => array ( "name" => 'Date To Start', "width" => "1"),
  '3' => array ( "name" => 'Date Due', "width" => "1"),
  '4' => array ( "name" => 'Date Completed', "width" => "1")
);
$row_data = array('yearmonth', 'dateAdded', 'dateToStart', 'dateDue','dateCompleted');

include ('views/header.php');
include ('views/table_stats.php');
include ('views/footer.php');
?>
