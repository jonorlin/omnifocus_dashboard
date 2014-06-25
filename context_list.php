<?php
include ('config.php');
$page_title = 'By Context';

$ret = $db->get_contexts();

$row_names = array(
  '0' => array ( "name" => 'Name', "width" => "10"),
  '1' => array ( "name" => 'Available Tasks', "width" => "1"),
  '2' => array ( "name" => 'Remaining Tasks', "width" => "1")
);

$row_data = array('name', 'availableTaskCount', 'remainingTaskCount');

include ('views/header.php');
include ('views/table_without_future_options.php');
include ('views/footer.php');
?>
