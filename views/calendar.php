View <a href="<?php echo $_SERVER["PHP_SELF"];?>">Current Month</a> |
<a href="calendar.php?year=<?php echo $cYear;?>&amp;month=<?php echo $cMonth;?>&amp;type=dateDue">Due</a> |
  <a href="calendar.php?year=<?php echo $cYear;?>&amp;month=<?php echo $cMonth;?>&amp;type=dateToStart">Start Dates</a>
  | <a href="calendar.php?year=<?php echo $cYear;?>&amp;month=<?php echo $cMonth;?>&amp;type=dateCompleted">Completed</a>

<table width="1200" class="table table-bordered table-condensed">

<tr align="center" bgcolor="#999999" style="color:#FFFFFF">

    <td></td>

    <td><a href="<?php echo $_SERVER['PHP_SELF']."?year=". $prev_year['year'] ."&month=". $prev_year['mon'] ?>"> <?php echo $prev_year_text;?> >></a></td>

    <td><a href="<?php echo $_SERVER['PHP_SELF']."?year=". $prev_month['year'] ."&month=". $prev_month['mon'] ?>"><?php echo $prev_month_text;?> ></a></td>

    <td><strong><?php echo $monthNames[$cMonth-1].' '.$cYear; ?></strong></td>

    <td><a href="<?php echo $_SERVER['PHP_SELF']."?year=". $next_month['year'] ."&month=". $next_month['mon']; ?>"> > <?php echo $next_month_text;?></a></td>

    <td><a href="<?php echo $_SERVER['PHP_SELF']."?year=". $next_year['year'] ."&month=". $next_year['mon'] ?>"> >> <?php echo $next_year_text;?></a></td>

    <td></td>

</tr>

<tr>
  <td align="center" class="col-sm-1"><strong>Monday</strong></td>
  <td align="center" class="col-sm-1"><strong>Tuesday</strong></td>
  <td align="center" class="col-sm-1"><strong>Wednesday</strong></td>
  <td align="center" class="col-sm-1"><strong>Thursday</strong></td>
  <td align="center" class="col-sm-1"><strong>Friday</strong></td>
  <td align="center" class="col-sm-1"><strong>Saturday</strong></td>
  <td align="center" class="col-sm-1"><strong>Sunday</strong></td>
</tr>

<tr>
<?php
// add days before month if any
for($i=1;$i<$total_days_to_display+1;$i++)
{

$cellTimeStamp = mktime(0,0,0,$cMonth,-$days_before_month_to_show+$i,$cYear);
$cellDate = date('d',$cellTimeStamp);
$cellMonth = date('m',$cellTimeStamp);


  echo "<td";
  if ($today_timestamp == $cellTimeStamp )
  { echo " class='info'";}

  if ($today_month != $cellMonth)
  { echo " class='warning'";}

  echo "><strong>".$cellDate."</strong><br />";
  while ($row = $ret->fetchArray() )
  {

    if ($row[$type] == date('Y-m-d',mktime(0,0,0,$cMonth,-$days_before_month_to_show+$i,$cYear) ) )
    {echo $row["taskName"]."<br /><br />";}
  }

  echo "</td>";

  if ($i % 7 == 0 && $i != $total_days_to_display) // its sunday, last day in row and don't do for last row
      {echo "</tr><tr>";}
}

?>
</tr>
</table>
