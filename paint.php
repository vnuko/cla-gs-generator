<?php

$version = "0.1.1";

//debugging
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

//include classes
require_once("classes/ClassGenerator.php");

//if form is submitted
if(isset($_POST['submit_form']))
{
	$db_host = $_POST['db_host'];
	$db_name = $_POST['db_name'];
	$db_username = $_POST['db_username'];
	$db_password = $_POST['db_password'];
	$table_name = $_POST['table_name'];
	
	//Open Connection
	$con = mysql_connect($db_host,$db_username,$db_password);
	if (!$con)
		die('Could not connect: ' . mysql_error());
	
	//DB name
	$con_db = mysql_select_db($db_name, $con);
	if (!$con_db)
		die("Cannot use: {$con_db}" . mysql_error());
	
	//Get All DB fields
	$sqlstr = mysql_query("describe {$table_name}");

	if (!$sqlstr)
		die("Error: " . mysql_error() );

	$arr = array();
	if (mysql_numrows($sqlstr) != 0) {
		while ($row = mysql_fetch_object($sqlstr)) {
			
			$arr[] = $row;
		}
	}

	//Close Connection
	mysql_close($con);

	if(empty($arr)) die('Error, cannot build the class');

	$draw_class = new ClassGenerator($arr);
	$draw_class->author =	(isset($_POST['name'])) ? $_POST['name'] : "";
	$draw_class->email = (isset($_POST['email'])) ? $_POST['email'] : "";
	$draw_class->project_name = (isset($_POST['project_name'])) ? $_POST['project_name'] : "";
	$draw_class->company = (isset($_POST['company'])) ? $_POST['company'] : "";
	$draw_class->company_email = (isset($_POST['company_email'])) ? $_POST['company_email'] : "";
	$draw_class->version = (isset($_POST['version'])) ? $_POST['version'] : "";
	$draw_class->class_name = (isset($_POST['class_name'])) ? $_POST['class_name'] : "DefaultClass";
	$draw_class->class_description = (isset($_POST['class_description'])) ? $_POST['class_description'] : "";
}
?>