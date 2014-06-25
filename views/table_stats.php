<p>See graphic view <a href="graph.php">here</a></p>
<p class="tip">
  <span class="label label-info">TIP!</span>  Sort multiple columns simultaneously by holding down the <kbd>Shift</kbd> key and clicking a second, third or even fourth column header
</p>

<div class="col-md-4">

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
foreach ($ret as $row)
{
// don't print empty yearmonth
if ($row["yearmonth"] != '')
{
echo "<tr>";
foreach ($row_data as $name)
{
  echo "<td>";
  echo $row[$name];
  echo "</td>";
}
echo "</tr>";
}
}
?>
</tbody>
</table>
</div>

<?php include('views/table_sort.php');?>
