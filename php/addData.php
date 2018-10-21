<?php
/**
 * Created by PhpStorm.
 * User: Marejean
 * Date: 4/13/17
 * Time: 11:36 AM
 */

include_once "classes/Controller.php";

$obj = new Controller();
$obj->addBeach($_POST["name"], 
				$_POST["location"], 
				$_POST["description"],
				$_POST["elevation"],
				$_POST["longitude"], 
				$_POST["latitude"],
				$_POST["thingsToDo"],
				$_POST["sandColor"],
				$_POST["waterClarity"],
				$_POST["waveIntensity"]
				);
