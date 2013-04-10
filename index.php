<?php include('paint.php'); ?>

<!DOCTYPE html>
<html>
	<head>
		<title>GS-Generator <?php echo $version; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap Path - uncomment line below -->
		<!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
	</head>
	<body>
		<div class="container">	

			<h2>GS-Generator <?php echo $version; ?></h2>
			<hr>
			<?php if(isset($draw_class)): ?>
				<small class="text-info"><strong><?php echo "Generated: ". date("d M Y, H:i:s"); ?></strong></small>
				<div class="hero-unit" style="font-family: Courier New; font-size: 13px; line-height:11px">
					<?php $draw_class->DrawClass(); ?>
				</div>
			<?php endif; ?>

			<form action="" method="POST">
			<div class="row-fluid">
				<div class="span6">
					<legend>DB Connection</legend>
    				<label>DB Host:</label>
    				<input type="text" class="xlarge" name="db_host" />
    				<label>Username:</label>
    				<input type="text" class="xlarge" name="db_username" />
    				<label>DB Password:</label>
    				<input type="password" class="xlarge" name="db_password" />
					<label>Database:</label>
					<input type="text" class="xlarge" name="db_name" />
					<label>Table:</label>
					<input type="text" class="xlarge" name="table_name" />
				</div>
				<div class="span6">
					<legend>Class Details</legend>
					<label>Class Name:</label>
					<input type="text" name="class_name" />
					<label>Author:</label>
					<input type="text" name="name" />
					<label>Email:</label>
					<input type="text" name="email" />
					<label>Project Name:</label>
					<input type="text" name="project_name" />
					<label>Company:</label>
					<input type="text" name="company" />
					<label>Company Email:</label>
					<input type="text" name="company_email" />
					<label>Version:</label>
					<input type="text" name="version" />
					<label>Class Description:</label> 
					<textarea rows="4" cols="20" name="class_description"></textarea>
				</div>
				<div class="span12">
					<hr>

					<input type="submit" name="submit_form" class="btn btn-large btn-success" value="Generate Code" />
				</div>
			</div>
			</form>
		</div>
	</body>
</html>