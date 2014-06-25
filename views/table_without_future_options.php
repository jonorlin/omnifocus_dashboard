<p class="tip">
  <span class="label label-info">TIP!</span>  Sort multiple columns simultaneously by holding down the <kbd>Shift</kbd> key and clicking a second, third or even fourth column header
</p>

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

<?php include('views/table_sort.php');?>
