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

$view->header($page_title, $contexts_list, $projects_list,$task_count);
$view->table_without_future_options($row_names, $row_data, $ret);
$view->footer();
?>
