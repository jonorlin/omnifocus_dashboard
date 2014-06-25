<?php
include ('config.php');
$page_title = 'Graphs';

$ret = $db->get_stats();

include ('views/header.php');
echo '<img src="assets/images/graph1.php" />';
echo '<img src="assets/images/graph2.php" />';
echo '<img src="assets/images/graph3.php" />';
echo '<img src="assets/images/graph4.php" /><br /><br />';

include ('views/footer.php');
?>
