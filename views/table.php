<p class="tip">
  <span class="label label-info">TIP!</span>  Sort multiple columns simultaneously by holding down the <kbd>Shift</kbd> key and clicking a second, third or even fourth column header
</p>

<?php
$future = (isset($_GET["future"]) ? $_GET["future"] : '' );
if ($future == 'hide') { ?>

<a href="action.php?t=<?php echo $_GET["t"];?>&amp;id=<?php echo $id ;?>" class="btn btn-default btn-lg active" role="button">Show future due or start actions and actions with on hold contexts</a>

<?php } else {?>
<a href="action.php?t=<?php echo $_GET["t"];?>&amp;id=<?php echo $id ;?>&amp;future=hide" class="btn btn-default btn-lg active" role="button">Hide future due or start actions and actions with on hold contexts</a>

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
  { echo '<button type="button" class="btn btn-warning btn-xs">completed</button> ';}
  echo $row[$name];
  if ($name == 'taskName')  {echo "</a>";
  echo '<a href="detail.php?tid=' .$row["tid"] . '"> <button type="button" class="btn btn-info btn-xs">Info</button></a>';}
  echo "</td>";
}
echo "</tr>";
}
?>
</tbody>
</table>

<?php include('views/table_sort.php');?>
