<?php
include ('config.php');
$page_title = 'Actions';

$id = (isset($_GET["id"]) ? $_GET["id"] : '' );

$ret = $db->get_all_tasks($_GET["t"], $id, "taskName, projectName");

$row_names = array(
  '0' => array ( "name" => 'Name', "width" => "6"),
  '1' => array ( "name" => 'Project', "width" => "2"),
  '2' => array ( "name" => 'Context', "width" => "2"),
  '3' => array ( "name" => 'Start Date', "width" => "1"),
  '4' => array ( "name" => 'Due Date', "width" => "1")
);

$row_data = array('taskName', 'projectName','contextName','dateToStart','dateDue');

include ('views/header.php');
include ('views/table.php');

if ($_GET["t"] == "context")
{
  $ret = $db->get_child_contexts($_GET["id"]);
  if ($ret->fetchArray() )
  {
    $ret->reset();  // since called above, $ret needs to be reset
    echo "Child Contexts";
    include ('views/table.php');
  }
}
include ('views/footer.php');
?>
