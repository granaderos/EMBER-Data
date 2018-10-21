<?php 

	include_once "../classes/Controller.php";

	$obj = new Controller();
	$obj->searchBeach($_POST["keyWord"]);