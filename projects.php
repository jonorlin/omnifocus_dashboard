<?php
include ('config.php');
$page_title = 'By Project';

$ret = $db->get_projects();

$row_names = array(
  '0' => array ( "name" => 'Name', "width" => "10"),
  '1' => array ( "name" => 'Available Tasks', "width" => "1"),
  '2' => array ( "name" => 'Remaining Tasks', "width" => "1"),
);

$row_data = array('name', 'numberOfAvailableTasks', 'numberOfRemainingTasks');

include ('views/header.php');
include ('views/table_without_future_options.php');
include ('views/footer.php');
?>
