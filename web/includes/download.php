<?php
	$progr_dir = "../../progr/";
	$file_name = $_GET["file"];
	$file_name = $path = str_replace('/', '_', $file_name);
	$file = $progr_dir .$file_name;

	if(!file_exists($file)) die("I'm sorry, the file doesn't seem to exist.");

	$type = filetype($file);
	// Get a date and timestamp
	$today = date("F j, Y, g:i a");
	$time = time();
	// Send file headers
	header("Content-type: $type");
	header("Content-Disposition: attachment;filename=$file_name");
	header("Content-Transfer-Encoding: binary"); 
	header('Pragma: no-cache'); 
	header('Expires: 0');
	// Send the file contents.
	set_time_limit(0); 
	readfile($file);
?>