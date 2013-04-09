<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>GS-Generator 1.0</title>
  </head>
  <body>
  	
  	<form action="paint.php" name="df" method="POST">
  		<fieldset>
		<legend>DB Connection</legend>
		<div class="clearfix"></div>
		<label>DB Host: *&nbsp;</label> <input type="text" class="xlarge" name="db_host" /><br /><br />
		<label>DB Username: *&nbsp;</label><input type="text" class="xlarge" name="db_username" /><br /><br />
		<label>DB Password: *&nbsp;</label><input type="password" class="xlarge" name="db_password" /><br /><br />
		<label>DB Name: *&nbsp;</label><input type="text" class="xlarge" name="db_name" /><br /><br />
		<label>DB Table Name: *&nbsp;</label><input type="text" class="xlarge" name="table_name" /><br /><br />
		<hr>
		
		<legend>Class Details</legend>
		<div class="clearfix"></div>
		<label>Author:&nbsp;</label> <input type="text" name="name" /><br /><br />
		<label>Email:&nbsp;</label> <input type="text" name="email" /><br /><br />
		<label>Project Name:&nbsp;</label> <input type="text" name="project_name" /><br /><br />
		<label>Company:&nbsp;</label> <input type="text" name="company" /><br /><br />
		<label>Company Email:&nbsp;</label> <input type="text" name="company_email" /><br /><br />
		<label>Version:&nbsp;</label> <input type="text" name="version" /><br /><br />
		<label>Class Name:&nbsp;</label> <input type="text" name="class_name" /><br /><br />
		<label>Class Description:&nbsp;</label> 
		<textarea rows="2" cols="20" name="class_description"></textarea><br /><br />
		
		<input type="submit" name="submit" class="btn primary" value="Submit" />
		</fieldset>
	</form>
  
  </body>
</html>