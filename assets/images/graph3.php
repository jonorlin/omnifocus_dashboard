<?php
include ('../../config.php');
include('../../assets/phpgraphlib-master/phpgraphlib.php');

$ret           = $db->get_stats();
$dateAdded     = array_column($ret, 'dateAdded','yearmonth');

$graph = new PHPGraphLib(1200, 250);
$graph->addData($dateAdded);
$graph->setTitle('Date Added');
$graph->setBarColor('red');
$graph->setDataValues(true);
$graph->createGraph();
?>
