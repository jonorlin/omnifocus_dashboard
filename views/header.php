<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title><?php echo SITE_NAME . " : ". $page_title;?></title>

  <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="assets/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/theme.css" rel="stylesheet">

    <!-- used for tablesorter -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script type="text/javascript" src="assets/js/jquery.min.js"></script>
     <!-- tablesorter script from http://tutsme-webdesign.info/bootstrap-3-sortable-table/ -->
     <link href="assets/css/theme.blue.css" rel="stylesheet">
     <script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.tablesorter.widgets.js"></script>

</head>
<body>
   <div class="container">
<h1><?php echo SITE_NAME . " : ". $page_title;?></h1>
<a href="index.php">Home</a> |
<a href="inbox.php">In Box (<?php echo $task_count["inBox"];?>)</a> |
<a href="action.php?t=all">All Actions  (<?php echo $task_count["dateAdded"];?>)</a> |
<a href="action.php?t=open">Open (<?php echo $task_count["openTasks"];?>)</a> |
<a href="action.php?t=startdate">By Start Dates (<?php echo $task_count["dateToStart"];?>)</a> |
<a href="action.php?t=duedate">By Due Dates (<?php echo $task_count["dateDue"];?>)</a> |
<a href="action.php?t=nodates">No Dates (<?php echo $task_count["noDates"];?>)</a> |
<a href="folders.php">Folders</a> |
<a href="completed.php">Completed (<?php echo $task_count["dateCompleted"];?>)</a> |
<a href="stats.php">Monthly Stats</a> |
<a href="graph.php">Graphs</a>
<hr />
<strong><a href="context_list.php">Active and On Hold Contexts:</a></strong>
<?php
while ($row = $contexts_list->fetchArray() )
  {
    // note: allowsNext Action will be 0 if context is on hold
    echo '<a href="action.php?t=context&id=' . $row["persistentIdentifier"] . '">'. ($row["allowsNextAction"] == 0 ? '<em>' : '') . $row["name"] . ' ('.  $row["remainingTaskCount"]  .')' . ($row["allowsNextAction"] == 0 ? '</em>' : '') . '</a> | ';
  }
?>
<hr />
<strong><a href="projects.php">Projects:</a></strong>
<?php
while ($row = $projects_list->fetchArray() )
  {
    echo '<a href="action.php?t=project&id=' . $row["pk"] . '">' . $row["name"] . ' ('. $row["numberOfRemainingTasks"]. ')</a> | ';
  }
echo "<br /><br />";
