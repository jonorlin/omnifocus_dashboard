<?php
include ('../../config.php');
include('../../assets/phpgraphlib-master/phpgraphlib.php');

$ret           = $db->get_stats();
$dateDue       = array_column($ret, 'dateDue','yearmonth');

$graph = new PHPGraphLib(1200, 250);
$graph->addData($dateDue);
$graph->setTitle('Due Dates');
$graph->setBarColor('red');
$graph->setDataValues(true);
$graph->createGraph();
?>
