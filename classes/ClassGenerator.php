<?php

/* ---

	ClassGenerator, a simple getters and & setters generator based on DB structure.
	Version 0.1.0, 09 April 2013

	Copyright (c) 2013 Milos Vnucko

	Permission is granted to anyone to use this software for any purpose,
	including commercial applications, and to alter it and redistribute it
	freely, subject to the following restrictions:

--- */

class ClassGenerator
{
	public $class_description;
	public $author;
	public $email;
	public $project_name;
	public $company;
	public $company_email;
	public $version;
	public $class_name;

	private $columns;

	public function __construct($columns)
	{
		$this->columns = $columns;
	}

	public function DrawClassComment()
	{
		$string =	"<br>" .
		  			"/**<br>".
					"* {$this->class_description}<br>".
					"* @author {$this->author} [{$this->email}]<br>".
					"* @package {$this->project_name}<br>".
					"* @copyright {$this->company} {$this->company_email}<br>".
					"* @version {$this->version} [11/10/2011 3:55:19 PM]<br>".
					"*/<br>";

		return $string;
	}

	public function DrawClassHeader($class_name)
	{
		if(empty($class_name)) $class_name = "NoName";

		$string =	"" .
					"class {$class_name} extends DBObject<br>".
					"{<br>";
		return $string;
	}

	public function DrawClassFooter()
	{
		$string =	"}<br>";
		return $string;
	}

	public function DrawClass()
	{
		echo "<?php";
		echo $this->BuildClassHeader();
		echo $this->BuildClassBody();
		echo $this->DrawClassFooter();
		echo "?>";
	}

	public function DrawComment($comment, $var_type, $var_name, $return_type, $is_get = false)
	{
		$string = 	"".
				  	"/**<br>".
					" * {$comment}<br>";
		if(!$is_get)
		{
			$string .= " * @param {$var_type} \${$var_name}<br>";
		}

		$string .= 	" * @return {$return_type}<br>".
					" */<br>";

		return $string;
	}

	public function DrawSetMethod($method_name, $var_name, $var_type)
	{
		$cast_string = "";

		if($var_type == "int")
			$cast_string = "(int)";

		$string = 	"".
					"public function Set".ucfirst($this->SanitazeToMethodName($method_name))."(\${$var_name})<br>".
					"{<br>".
					"    \$this->{$var_name} = {$cast_string}\${$var_name};<br>".
					"    return \$this;<br>".
					"}<br>";

		return $string;
	}

	public function DrawGetMethod($method_name, $var_name)
	{
		$string = 	"".
					"public function Get".ucfirst($this->SanitazeToMethodName($method_name))."()<br>".
					"{<br>".
					"    return \$this->{$var_name};<br>".
					"}<br>";

		return $string;
	}

	private function SanitazeToMethodName($string)
	{
		$s = str_replace("_", " ", $string);
		$s = ucwords($s);
		$s = str_replace(" ", "", $s);

		return $s;
	}

	private function SanitazeToReadableName($string)
	{
		$s = str_replace("_", " ", $string);
		$s = ucwords($s);

		return $s;
	}

	private function SanitazeToReadableType($string)
	{
		$replacement = "";

		//Date in claromentis
		//if($string == "decimal(14,0)")
			//return "int";
		//else

		$type = preg_replace("/\([0-9]*\)/", $replacement, $string);
		if($type == "varchar") $type = "string";

		return $type;
	}

	public function BuildClassBody()
	{
		$string = "<br>";
		foreach($this->columns as $column)
		{
			//Getter
			$string .= $this->DrawComment(	"Get {$this->SanitazeToReadableName($column->Field)}",
											$this->SanitazeToReadableType($column->Type),
											$column->Field,
											$this->SanitazeToReadableType($column->Type),
											true
										  );
			$string .= $this->DrawGetMethod(	$this->SanitazeToMethodName($column->Field),
												$column->Field
											);
			$string .= "<br>";

			//Setter
			$string .= $this->DrawComment(	"Set {$this->SanitazeToReadableName($column->Field)}",
											$this->SanitazeToReadableType($column->Type),
											$column->Field,
											"\$this"
										  );
			$string .= $this->DrawSetMethod($this->SanitazeToMethodName($column->Field), $column->Field, $this->SanitazeToReadableType($column->Type));
			$string .="<br>";
		}

		return $string;
	}

	public function BuildClassHeader()
	{
		$string = "";
		$string .= $this->DrawClassComment();
		$string .= $this->DrawClassHeader($this->class_name);

		return $string;
	}
}