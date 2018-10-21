<?php 
	include_once "../classes/Controller.php";

	$obj = new Controller();
	$obj->displaySpecificBeach($_GET["beachId"]);