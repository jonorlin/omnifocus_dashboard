<table class="table tablesorter table-striped table-bordered table-condensed table-hover" id="mytable">
<thead>
  <tr class="info">
<th class="col-sm-2">Field</th>
<th class="col-sm-2">Data</th>
  </tr>
</thead>
<tbody>
<?php
$numberOfColumns = $ret->numColumns();

while ($row = $ret->fetchArray())
{
    for ($i = 1; $i < $numberOfColumns; $i++)
    {
        echo "<tr><td>";
        echo $ret->columnName($i);
        echo "</td><td>";
        echo $row[$i];
        echo "</td></tr>";
    }
}
?>
</tbody>
</table>

<?php include('views/table_sort.php');?>
