<?php
include ('config.php');
$page_title = 'In Box';

$ret = $db->get_inbox();

$row_names = array(
  '0' => array ( "name" => 'Task', "width" => "12"),
);

$row_data = array('taskname');

include ('views/header.php');
include ('views/table_without_future_options.php');
include ('views/footer.php');
?>
