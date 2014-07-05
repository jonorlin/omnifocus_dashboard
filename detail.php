<?php
include ('config.php');
$page_title = 'Action Detail';

$ret = $db->get_action_details($_GET["tid"]);


include ('views/header.php');
include ('views/details.php');
include ('views/footer.php');
?>
