<?php
include ('config.php');
$page_title = 'By Folder';

$ret = $db->get_folders();

$row_names = array(
  '0' => array ( "name" => 'Name', "width" => "10"),
  '1' => array ( "name" => 'Available Tasks', "width" => "1"),
  '2' => array ( "name" => 'Due Soon', "width" => "1")
);
$row_data = array('name', 'numberOfAvailableTasks', 'numberOfDueSoonTasks');

include ('views/header.php');
include ('views/table_without_future_options.php');
include ('views/footer.php');
?>
