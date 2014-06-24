<?php
class View
{

public function footer()
{
  ?>
 </div>
</body>
</html>
<?php
}

public function header($page_title, $contexts_list, $projects_list,$task_count)
{
  ?>
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
<a href="action.php?t=open">Open Actions (<?php echo $task_count["openTasks"];?>)</a> |
<a href="action.php?t=startdate">By Start Dates (<?php echo $task_count["dateToStart"];?>)</a> |
<a href="action.php?t=duedate">By Due Dates (<?php echo $task_count["dateDue"];?>)</a> |
<a href="action.php?t=nodates">Actions No Dates (<?php echo $task_count["noDates"];?>)</a> |
<a href="folders.php">Folders</a> |
<a href="completed.php">Completed Actions (<?php echo $task_count["dateCompleted"];?>)</a>
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
}

function table($row_names, $row_data, $ret)
{
  ?>
	<p class="tip">
		<span class="label label-info">TIP!</span>  Sort multiple columns simultaneously by holding down the <kbd>Shift</kbd> key and clicking a second, third or even fourth column header
	</p>

<?php
$future = (isset($_GET["future"]) ? $_GET["future"] : '' );

if ($future == 'hide') { ?>

<a href="action.php?t=<?php echo $_GET["t"];?>&amp;id=<?php echo $_GET["id"] ;?>" class="btn btn-default btn-lg active" role="button">Show future due or start actions and actions with on hold contexts</a>

<?php } else {?>
<a href="action.php?t=<?php echo $_GET["t"];?>&amp;id=<?php echo $_GET["id"] ;?>&amp;future=hide" class="btn btn-default btn-lg active" role="button">Hide future due or start actions and actions with on hold contexts</a>

<?php
}
?>

  <table class="table tablesorter table-striped table-bordered table-condensed table-hover" id="mytable">
  <thead>
  <tr class="info">
<?php
foreach ($row_names as $row)
{
  echo '<th class="col-sm-' . $row["width"] . '">' . $row["name"] . "</th>";
}
?>
    </tr>
  </thead>
  <tbody>
<?php
while ($row = $ret->fetchArray() )
{
  echo "<tr>";
  foreach ($row_data as $name)
  {
    echo "<td>";
    if ($name == 'taskName') {echo '<a href="omnifocus:///task/'. $row["tid"]. '">';}
    if ($name == 'taskName' && !is_null($row["dateCompleted"]) )
    { echo "[completed] ";}
    echo $row[$name];
    if ($name = 'taskName')  {echo "</a>";}
    echo "</td>";
  }
  echo "</tr>";
}
?>
</tbody>
</table>

<script>
  $(document).ready(function(){
  $(function(){
  $("#mytable").tablesorter({
    theme: "blue"
  });
  });
  });
</script>

<?php
}
}

$view = new View();
?>
