<?php
include ('config.php');
$page_title = 'In Box';

$ret = $db->get_inbox();

$row_names = array(
  '0' => array ( "name" => 'Task', "width" => "12"),
);

$row_data = array('taskname');

$view->header($page_title, $contexts_list, $projects_list,$task_count);
$view->table_without_future_options($row_names, $row_data, $ret);
$view->footer();
?>
