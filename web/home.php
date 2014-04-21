<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Weigel World Bioinformatics Portal</title>
	
	
	<link rel="stylesheet" type="text/css" media="all" href="./css/main.css">


	<style type="text/css">
		div#Webtools{}
	</style>
	<link rel="stylesheet" type="text/css" href="./css/niftyCorners.css">
	<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="js/funcs.js"></script>
	<!--script type="text/javascript" src="./js/niftycube.js"></script-->
	<script type="text/javascript">
	window.onload=function(){
		Nifty("div#Webtools","big transparent");
		Nifty("div#NavColumn","medium transparent tr br");
	}
	</script>

<link type="text/css" rel="stylesheet" href="./css/niftyCorners.css" media="screen"></head><style type="text/css">embed[type*="application/x-shockwave-flash"],embed[src*=".swf"],object[type*="application/x-shockwave-flash"],object[codetype*="application/x-shockwave-flash"],object[src*=".swf"],object[codebase*="swflash.cab"],object[classid*="D27CDB6E-AE6D-11cf-96B8-444553540000"],object[classid*="d27cdb6e-ae6d-11cf-96b8-444553540000"],object[classid*="D27CDB6E-AE6D-11cf-96B8-444553540000"]{	display: none !important;}</style>

<body>

<div id="OuterWrapper">
	<div id="Wrapper">
		<a href="home.php">
		<div id="Header">	
		<h1>
<pre>
Clustel Omega 
    Online
</pre>
		</h1></a>
		</div>
		
		<div id="PageContainer">

			<div id="Content">
				<div id="LeftColumn">
					<div id="NavColumn" style="padding-top: 0px; padding-bottom: 0px;">
					
						<h5>Helpful sites</h5>
						<ul>
							<li><a href="https://www.ebi.ac.uk/Tools/msa/clustalo/">EMBL-EBI ClustalO</a></li>
							<li><a href="http://www.clustal.org/omega/">Link2</a>Clustal Omega</li>
							<li><a href="http://www.ncbi.nlm.nih.gov/">NCBI</a></li>
							<li><a href="http://www.tu-sofia.bg">TU-Sofia</a></li>
						</ul>
						
					</div>
				</div>
				
				<div id="BodyColumn">
	
					<div id="BodySection">
						<h1>Добре дошли в Clustal Omega Tool Online!</h1>
					</div>
					
					<div id="NewsContainer">
						<table width="100%" border="0px">
						<tbody><tr>
						<td valign="top" width="48%">
						<div id="Webtools" style="padding-top: 0px; padding-bottom: 0px;">
						
							<?php
								if($_SERVER['REQUEST_METHOD'] !== 'POST'){
									if(!isset($_GET["help"])){									
										require("pages/content.php");
									}
									else{						
										require("pages/help.php");
									}
								}
								
								require("pages/result.php");
							?>
							
						</div>								
						</td>
						<td width="10%">
						</td>
						</tr>
						</tbody></table>
					</div>
				</div>
			</div>

			<div id="Footer">
				<div id="FooterBox">
					© ТУ-София: КСТ; Clustalo Omega ver. 
					<?php 
						$ver = `"../progr/clustalo.exe" --version`;
						echo $ver;
					?>
				</div>
			</div>
		</div>
	</div>
</div>

</body></html>
