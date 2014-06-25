<?php
include ('config.php');
$page_title = 'Completed';

$ret = $db->get_all_tasks("completed",0, "dateCompleted DESC, taskName");

$row_names = array(
  '0' => array ( "name" => 'Name', "width" => "7"),
  '1' => array ( "name" => 'Project', "width" => "2"),
  '2' => array ( "name" => 'Context', "width" => "1"),
  '3' => array ( "name" => 'Due Date', "width" => "1"),
  '4' => array ( "name" => 'Completed Date', "width" => "1")
);

$row_data = array('taskName', 'projectName','contextName','dateDue','dateCompleted');

include ('views/header.php');
include ('views/table_without_future_options.php');
include ('views/footer.php');
?>
