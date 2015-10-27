<?php
require_once("controller/MasterController.php");
$mc = new \controller\MasterController();
header('Content-Type: text/html; charset=ISO-8859-1');
$mc->doGallery();