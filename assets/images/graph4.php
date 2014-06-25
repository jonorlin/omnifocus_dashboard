<?php
include ('../../config.php');
include('../../assets/phpgraphlib-master/phpgraphlib.php');

$ret           = $db->get_stats();
$dateCompleted = array_column($ret, 'dateCompleted','yearmonth');

$graph = new PHPGraphLib(1200, 250);
$graph->addData($dateCompleted);
$graph->setTitle('Date Completed');
$graph->setBarColor('red');
$graph->setDataValues(true);
$graph->createGraph();
?>
