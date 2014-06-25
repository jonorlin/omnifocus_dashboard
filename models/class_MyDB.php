<?php
class MyDB extends SQLite3
{
   function __construct()
   {
    $db = $this->open( OMNIFOCUS_SQL_FILE , SQLITE3_OPEN_READONLY);
   }

   function get_contexts()
   {  // just active ones
	 $sql = "SELECT name, availableTaskCount, remainingTaskCount, allowsNextAction, persistentIdentifier
   FROM Context
   WHERE active = 1
   AND remainingTaskCount > 0
   ORDER BY name";

	 return $this->query($sql);
   }


   function get_stats()
   {
    $year_table = array();
    $date_types = array('dateAdded','dateToStart','dateDue','dateCompleted');
    foreach ($date_types as $field)
    {
      $$field = $this->get_single_stats($field);
      while($row = $$field->fetchArray() )
      {  // adds to the table such as 2014-06[dateAdded] = count
        $year_table[$row["yearmonth"] ] [$field] = $row[$field];
        $year_table[$row["yearmonth"] ] ["yearmonth"] = $row["yearmonth"];
      }
    }

    // fill in 0 values for null data
    // needed to clean up undefined index's
    // TODO could make this separate function
    foreach($year_table as $row)
    {
      foreach ($date_types as $field)
        {
          if (!isset($row[$field]) )
          { $year_table[$row["yearmonth"]] [$field] = 0;}
        }
     }
     // sort by year-month
     ksort($year_table);
     return $year_table;
  }


   private function get_single_stats($field)
   {
     $sql = "SELECT
     count($field) as $field,
     strftime('%Y-%m',$field + 978307200, 'unixepoch','localtime') as yearmonth
    FROM Task
    WHERE ProjectInfo ISNULL
    GROUP BY yearmonth";

    return $this->query($sql);
   }

  function count_tasks()
  { // Task.ProjectInfo IS NULL confirms no projects counted
    $sql = 'SELECT
    count(dateAdded) as dateAdded,
    count(dateCompleted) as dateCompleted,
    count(case WHEN inInbox = 1 THEN dateAdded else NULL end) as inBox,
    count(case WHEN dateCompleted ISNULL THEN dateAdded else NULL end) as openTasks,
    count(case WHEN Task.dateCompleted ISNULL
    AND Task.dateDue ISNULL
    AND Task.dateToStart ISNULL THEN dateAdded else NULL end) as noDates,
    count(case WHEN dateCompleted ISNULL THEN dateToStart else NULL end) as dateToStart,
    count(case WHEN dateCompleted ISNULL THEN dateDue else NULL end) as dateDue
    FROM Task
    WHERE ProjectInfo ISNULL';

    return $this->querySingle($sql,TRUE);
  }

   function get_child_contexts($id)
   {
  $sql ="SELECT Task.name as taskName, Context.name as contextName,
  date(Task.dateToStart + 978307200, 'unixepoch', 'localtime') AS dateToStart,
  date(Task.dateDue + 978307200, 'unixepoch', 'localtime') AS dateDue,
  pk, Task.persistentIdentifier as tid, ProjectTasks.name AS projectName,
date(Task.dateCompleted + 978307200, 'unixepoch', 'localtime') AS dateCompleted
    FROM Task, Context, ProjectInfo
    JOIN Task AS ProjectTasks ON ProjectInfo.pk = ProjectTasks.persistentIdentifier
    WHERE Task.context = Context.persistentIdentifier
    AND Task.containingProjectInfo = ProjectInfo.pk
    AND ProjectInfo.status IN ( 'active' , 'inactive')
    AND context.active = '1'
    AND Task.dateCompleted ISNULL
    AND Context.parent = '$id' ";

    return $this->query($sql);
   }

   function get_folders()
	{
	$sql ="SELECT name, numberOfAvailableTasks, numberOfDueSoonTasks
		     FROM Folder
		     WHERE active  = 1
		     ORDER BY name";

	return $this->query($sql);
	}

   function get_projects()
	{  // ProjectInfo.status is either active, dropped, or inactive
	$sql ="SELECT Task.name, numberOfAvailableTasks, numberOfRemainingTasks,
       pk, status
	     FROM Task, ProjectInfo
		   WHERE Task.persistentIdentifier = ProjectInfo.pk
		   AND ProjectInfo.status IN ( 'active' , 'inactive')
		   ORDER BY name";

	return $this->query($sql);
	}

  function get_completed_tasks()
  {
  $sql ="SELECT Task.name as taskName, Context.name as contextName,
  date(Task.dateDue + 978307200, 'unixepoch', 'localtime') AS dueDate,
  date(Task.dateCompleted + 978307200, 'unixepoch', 'localtime') AS dateCompleted
    FROM Task, Context
    WHERE Task.context = Context.persistentIdentifier
    AND Task.dateCompleted > 0
    ORDER BY dueDate, contextName";

  return $this->query($sql);
  }

  function get_inbox()
 {
 $sql ="SELECT Task.name as taskname
    FROM Task
    WHERE Task.inInbox = 1
    ORDER BY taskname";
 return $this->query($sql);
 }


  function get_all_tasks($t, $id, $order)
  { // used on the home page and actions.php pages
    // Task.ProjectInfo ISNULL insures that projects don't appear
  $filter = '';

switch ($t) {

case 'context':
     if (ISSET($id) )
     { $filter = " AND Task.context = '". $id. "' AND Task.dateCompleted ISNULL";}
      break;

case 'project':
      if (ISSET($id) )
      { $filter = " AND ProjectInfo.pk = '". $id. "' AND Task.dateCompleted ISNULL";}
      break;

case 'startdate':
  $filter = " AND Task.dateToStart NOTNULL AND Task.dateCompleted ISNULL";
  $order = "dateToStart";
  break;

case 'duedate':
  $filter = " AND Task.dateDue NOTNULL AND Task.dateCompleted ISNULL";
  $order = "dateDue";
  break;

case 'completed':
  $filter = " AND Task.dateCompleted NOTNULL";
  break;

case 'nodates':
  $filter = " AND Task.dateCompleted ISNULL
  AND Task.dateDue ISNULL
  AND Task.dateToStart ISNULL";
  break;

case 'all':
// this includes completed tasks
  $order = 'dateDue';
  break;

case 'open':
  $filter = " AND Task.dateCompleted ISNULL";
  break;

default:
// so tasks with no context don't appear on home page
  $filter = " AND Context.Name != 'NULL' AND Task.dateCompleted ISNULL";
  break;
}

$future = (isset($_GET["future"]) ? $_GET["future"] : '' );

if($future == 'hide')
{
  $show_future_tasks = " AND
  ( date(Task.dateToStart + 978307200, 'unixepoch', 'localtime') <= date('now', 'localtime')
  OR Task.dateToStart ISNULL )
          AND
  ( date(Task.dateDue + 978307200, 'unixepoch', 'localtime') <= date('now', 'localtime')
  OR Task.dateDue ISNULL )
          AND
  ( Context.allowsNextAction = 1  OR Context.allowsNextAction ISNULL ) ";
}
else
{
  $show_future_tasks = '';
}

    $sql ="SELECT Task.name as taskName, Context.name as contextName,
date(Task.dateToStart + 978307200, 'unixepoch', 'localtime') AS dateToStart,
date(Task.dateDue + 978307200, 'unixepoch', 'localtime') AS dateDue,
date(Task.dateCompleted + 978307200, 'unixepoch', 'localtime') AS dateCompleted,
pk, Task.persistentIdentifier as tid,
ProjectTasks.name AS projectName,
Context.allowsNextAction
   FROM Task, ProjectInfo
   LEFT JOIN Task AS ProjectTasks
ON ProjectInfo.pk = ProjectTasks.persistentIdentifier

   LEFT JOIN Context
   ON Context.persistentIdentifier = Task.context
   AND context.active = '1'

  WHERE Task.containingProjectInfo = ProjectInfo.pk
  AND ProjectInfo.status IN ( 'active' , 'inactive')
  AND Task.ProjectInfo ISNULL
  $filter
  $show_future_tasks
  ORDER BY ". $order;
  return $this->query($sql);
  }
}

$db = new MyDB();
if (!$db)
{
   echo $db->lastErrorMsg();
}
// needed for top nav on all pages - could handle better in future
$contexts_list  = $db->get_contexts();
$projects_list  = $db->get_projects();
$task_count     = $db->count_tasks();
?>
