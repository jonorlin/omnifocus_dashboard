<?php
include ('config.php');
$page_title = 'Home Page';

$tasks = $db->get_all_tasks('', '', 'contextName, taskName');

include ('views/header.php');
?>

<div class="row">
  <div class="col-md-4">
	<h4 class="bg-danger">Overdue</h4>
  <?php
  $heading = '';
  while ($row = $tasks->fetchArray() )
  {
      if (  $row["dateDue"] < date('Y-m-d')
      && $row["dateDue"] != '' )
      {include ('views/section.php');}
  }
  ?>

	<h4 class="bg-warning">Due Today</h4>

  <?php
  $heading = '';
  while ($row = $tasks->fetchArray() )
  {
      if ( $row["dateDue"] == date('Y-m-d') )
      {include ('views/section.php');}
  }
  ?>

<h4 class="bg-success">Due Tomorrow</h4>

<?php
$heading = '';
while ($row = $tasks->fetchArray() )
{
    if ( $row["dateDue"] == date('Y-m-d' , strtotime ('+1 day') ) )
    {include ('views/section.php');}
}
?>

<h4 class="bg-info">Due This Week</h4>
<?php
$heading = '';
while ($row = $tasks->fetchArray() )
{
    if ( $row["dateDue"] > date('Y-m-d' , strtotime ('+1 day') )
      && $row["dateDue"] <= date('Y-m-d' , strtotime ('+7 day') )
    )
    {include ('views/section.php');}
}
?>

   </div>
  <div class="col-md-4">


<h4 class="bg-danger">Overdue by Start Day</h4>
<?php
$heading = '';
while ($row = $tasks->fetchArray() )
{
    if (  $row["dateToStart"] < date('Y-m-d')
    && $row["dateToStart"] != '' )
    { include ('views/section.php');}
}
?>
<h4 class="bg-warning">Start Today</h4>

<?php
$heading = '';
while ($row = $tasks->fetchArray() )
{
    if ( $row["dateToStart"] == date('Y-m-d') )
    {include ('views/section.php');}
}
?>

<h4 class="bg-success">Start Tomorrow</h4>
<?php
$heading = '';
while ($row = $tasks->fetchArray() )
{
    if ( $row["dateToStart"] == date('Y-m-d' , strtotime ('+1 day') ) )
    {include ('views/section.php');}
}
?>

<h4 class="bg-info">Start This Week</h4>
<?php
$heading = '';
while ($row = $tasks->fetchArray() )
{
    if ( $row["dateToStart"] > date('Y-m-d' , strtotime ('+1 day') )
      && $row["dateToStart"] <= date('Y-m-d' , strtotime ('+7 day') )
    )
    {include ('views/section.php');}
}
?>

   </div>
  <div class="col-md-4">

<h4 class="bg-primary">Active Actions with Context but no dates</h4>

<?php
$heading = '';
while ($row = $tasks->fetchArray() )
{

  if ( ($row["dateToStart"]) == '' && $row["dateDue"] == '' && $row["allowsNextAction"] == "1" )
  {include ('views/section.php');}
}
?>
   </div>
</div>
<?php
include ('views/footer.php');
?>
