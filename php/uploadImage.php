<?php
/**
 * Created by PhpStorm.
 * User: Marejean
 * Date: 8/19/16
 * Time: 2:11 PM
 */

include_once "classes/Controller.php";

$fp = fopen($_FILES["inpImage"]["tmp_name"], 'r'); 
$imgData = fread($fp, filesize($_FILES["inpImage"]["tmp_name"])); 
$imgData = addslashes($imgData); 
fclose($fp);

$obj = new Controller();
$obj->uploadBeachImage($_POST["selBeaches"], mysql_real_escape_string($imgData), $_FILES['inpImage']['type']);