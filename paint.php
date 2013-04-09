<!DOCTYPE html>
<html>
<head>
	<title>Title of the document</title>
</head>

<body>
<pre>

<?php
include("classes/ClassGenerator.php");

ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

if($_POST['submit'])
{
	$db_host = $_POST['db_host'];
	$db_name = $_POST['db_name'];
	$db_username = $_POST['db_username'];
	$db_password = $_POST['db_password'];
	$table_name = $_POST['table_name'];
	
	//Connection
	$con = mysql_connect($db_host,$db_username,$db_password);
	if (!$con)
		die('Could not connect: ' . mysql_error());
	
	//DB name
	mysql_select_db($db_name);
	
	//Get All fields
	$sqlstr = mysql_query("describe {$table_name}");
	$arr = array();
	if (mysql_numrows($sqlstr) != 0) {
		while ($row = mysql_fetch_object($sqlstr)) {
			
			$arr[] = $row;
		}
	}

	$draw_class = new ClassGenerator($arr);
	$draw_class->author =	(isset($_POST['name'])) ? $_POST['name'] : "";
	$draw_class->email = (isset($_POST['email'])) ? $_POST['email'] : "";
	$draw_class->project_name = (isset($_POST['project_name'])) ? $_POST['project_name'] : "";
	$draw_class->company = (isset($_POST['company'])) ? $_POST['company'] : "";
	$draw_class->company_email = (isset($_POST['company_email'])) ? $_POST['company_email'] : "";
	$draw_class->version = (isset($_POST['version'])) ? $_POST['version'] : "";
	$draw_class->class_name = (isset($_POST['class_name'])) ? $_POST['class_name'] : "DefaultClass";
	$draw_class->class_description = (isset($_POST['class_description'])) ? $_POST['class_description'] : "";
	$draw_class->DrawClass();
}

mysql_close($con);
?>

</pre>
</body>
</html>