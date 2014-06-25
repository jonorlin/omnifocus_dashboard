<?php
include ('../../config.php');
include('../../assets/phpgraphlib-master/phpgraphlib.php');

$ret           = $db->get_stats();

$dateToStart   = array_column($ret, 'dateToStart','yearmonth');

$graph = new PHPGraphLib(1200, 250);
$graph->addData($dateToStart);
$graph->setTitle('Start Dates');
$graph->setBarColor('red');
$graph->setDataValues(true);
$graph->createGraph();
?>
