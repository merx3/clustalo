
<div style="font-size: 18pt; padding-top: 30px;	padding-bottom: 15px;">Помощ</div>

<pre>
<?php
	//system("\"../progr/clustalo.exe\" --help", $output, $ret_val);
	//$output = `"../progr/clustalo.exe" --help`;
	$output = shell_exec('"../progr/clustalo.exe" --help');
	echo $output;
?>
</pre>

<br/><br/>
<a href="http://www.clustal.org/omega/README">More details</a>
<br/><br/>

<form action="home.php">
	<input type="submit" value="OK">
</form>