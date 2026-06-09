<?php
require_once 'connect.php';

require_once 'controllers/HomeController.php';
require_once 'config/database.php';
$controller = new HomeController($conn);

$controller->index();
?>