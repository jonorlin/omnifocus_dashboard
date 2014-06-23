<?php
if ($heading != $row["contextName"])
{
  echo '<button type="button" class="btn btn-' . ($row["allowsNextAction"] == '0' ? 'warning' : 'primary') . '">' .$row["contextName"] . "</button><br />";
  $heading = $row["contextName"];
}
echo  '<a href="omnifocus:///task/'. $row["tid"]. '">'. $row["taskName"] . "</a><br ><br >";
?>
