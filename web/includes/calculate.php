<?php
ini_set('max_execution_time', 0);
	
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	// Read all recieved data
	$input_sequence = trim($_POST["ta_sequence"]);
	if(empty($input_sequence) && isset($_POST["upl_in"])){
		$input_sequence =  trim($_POST["upl_in"]);
	}
	if(isset($_POST["hmm_file_in"])){
		$hmm_file_content = $_POST["hmm_file_in"]; 
	}
	$seq_type = $_POST["seq_type"];
	$in_file_format = $_POST["in_file_format"];
	$out_file_format = $_POST["out_file_format"];
	$out_file_ext = trim($_POST["out_file_ext"]);
	$dealign_checkbox = is_checkbox_checked("dealign");		
	if(isset($_POST["pre_align_in1"])){
		$pre_align_file1_content = $_POST["pre_align_in1"]; 
	}	
	if(isset($_POST["pre_align_in2"])){
		$pre_align_file2_content = $_POST["pre_align_in2"]; 
	}
	$check_corrrect_prof_checkbox = is_checkbox_checked("check_corrrect_prof");	
	if(isset($_POST["dist_matr_in"])){
		$dist_matr_file_content = $_POST["dist_matr_in"]; 
	}
	$dist_matr_out_checkbox = is_checkbox_checked("dist_matr_out");			
	if(isset($_POST["guide_tree_in"])){
		$guide_tree_file_content = $_POST["guide_tree_in"]; 
	}
	$guide_tree_out_checkbox = is_checkbox_checked("guide_tree_out");
	$use_full_matr_checkbox = is_checkbox_checked("use_full_matr");
	$use_full_matr_iter_checkbox = is_checkbox_checked("use_full_matr_iter");
	$max_seq_sub_clusters = (int)$_POST["max_seq_sub_clusters"];
	$cluster_out_checkbox = is_checkbox_checked("cluster_out");
	$use_kimura_checkbox = is_checkbox_checked("use_kimura");
	$dist_to_perc_checkbox = is_checkbox_checked("dist_to_perc");
	$msa_out_order = $_POST["msa_out_order"];
	$num_iter = $_POST["num_iter"];
	$max_guidetree_iter = $_POST["max_guidetree_iter"];
	$max_hmm_iter = $_POST["max_hmm_iter"];
	$max_seq_count = $_POST["max_seq_count"];
	$max_seq_length = $_POST["max_seq_length"];
	
	
	//  Create windows command line
	//  Input files:
	//    input.txt
	//    hmm.txt
	//    pre1.txt
	//    pre2.txt
	//    dist_matr.txt
	//    guide_tree.txt
	// Output files:
	//    out.???
	//    dist_matr_out.txt
	//    guide_tree_out.txt
	//    cluster_out.txt
	
	$progr_dir = "../../progr/";
	$command = "\"".$progr_dir."clustalo.exe\"";
	
	
	if(isset($out_file_format)){			
		$command .= " --outfmt=".$out_file_format;
	}

	$out_file="out";
	if(empty($out_file_ext)){
		switch($out_file_format){
			case "fasta":
				$out_file .= ".fasta";
				break;
			case "clustal":
				$out_file .= ".aln";
				break;
			case "msf":
				$out_file .= ".msf";
				break;
			case "phylip":
				$out_file .= ".phy";
				break;
			case "selex":
				$out_file .= ".slx";
				break;
			case "stockholm":
				$out_file .= ".sth";
				break;
			case "vienna":
				$out_file .= ".vie";
				break;
			default: 
				throw new Exception('Unsuported output format.');
		}
	}
	else
	{		
		$out_file .= (substr( $out_file_ext, 0, 1 ) === "." ? $out_file_ext : ".".$out_file_ext);
	}
	$command .= " --outfile=".$progr_dir.$out_file;		
	
	if(empty($input_sequence)){
		echo "<b>Error. Input sequence is missing<b>";
		die();
	}	
	$input_file_name = $progr_dir."input.txt";
	create_file($input_file_name , $input_sequence);	
	$command .= " --infile=".$input_file_name;
	
	if(isset($hmm_file_content)){		
		$hmm_file_name = $progr_dir."hmm.txt";
		create_file($hmm_file_name , $hmm_file_content);	
		$command .= " --hmm-in=".$hmm_file_name;
	}
	if($dealign_checkbox){
		$command .= " --dealign";
	}	
	if(isset($pre_align_file1_content)){		
		$pre_align_file1_name = $progr_dir."pre1.txt";
		create_file($pre_align_file1_name , $pre_align_file1_content);	
		$command .= " --profile1=".$pre_align_file1_name;
	}
	if(isset($pre_align_file2_content)){		
		$pre_align_file2_name = $progr_dir."pre2.txt";
		create_file($pre_align_file2_name , $pre_align_file2_content);	
		$command .= " --profile2=".$pre_align_file2_name;
	}
	if($check_corrrect_prof_checkbox){
		$command .= " --is-profile";
	}		
	if(isset($seq_type) && $seq_type !== 'auto'){		
		$command .= " --seqtype=".$seq_type;
	}
	if(isset($in_file_format) && $in_file_format !== 'auto'){		
		$command .= " --infmt=".$in_file_format;
	}
	if(isset($dist_matr_file_content)){		
		$dist_matr_file_name = $progr_dir."dist_matr_in.txt";
		create_file($dist_matr_file_name , $dist_matr_file_content);	
		$command .= " --dist_matr_in=".$dist_matr_file_name;
	}
	if($dist_matr_out_checkbox){
		$dist_matr_out_file_name = $progr_dir."dist_matr_out.txt";
		$command .= " --distmat-out=".$dist_matr_out_file_name;
	}	
	if(isset($guide_tree_file_content)){		
		$guide_tree_file_name = $progr_dir."guide_tree_in.txt";
		create_file($guide_tree_file_name , $guide_tree_file_content);	
		$command .= " --guidetree_in=".$guide_tree_file_name;
	}
	if($guide_tree_out_checkbox){
		$guide_tree_out_file_name = $progr_dir."guide_tree_out.txt";
		$command .= " --guidetree-out=".$guide_tree_out_file_name;
	}	
	if($use_full_matr_checkbox){
		$command .= " --full";
	}	
	if($use_full_matr_iter_checkbox){
		$command .= " --full-iter";
	}	
	if(isset($max_seq_sub_clusters) && $max_seq_sub_clusters > 0)
	{
		$command .= " --cluster-size=".$max_seq_sub_clusters;
	}	  
	if($cluster_out_checkbox){
		$cluster_file_name = $progr_dir."cluster_out.txt";
		$command .= " --clustering-out=".$cluster_file_name;
	}	
	if($use_kimura_checkbox){
		$command .= " --use-kimura";
	}	
	if($dist_to_perc_checkbox){
		$command .= " --percent-id";
	}	
	if(isset($msa_out_order) && !empty($msa_out_order)){
		if($msa_out_order === "input-order"){
			$command .= " --output-order=input-order";
		}
		else if ($msa_out_order === "tree-order"){
			$command .= " --output-order=tree-order";
		}
	}	
	if(isset($num_iter) && $num_iter > 0)
	{
		$command .= " --iterations=".$num_iter;
	}	
	if(isset($max_guidetree_iter) && $max_guidetree_iter > 0)
	{
		$command .= " --max-guidetree-iterations=".$max_guidetree_iter;
	}	
	if(isset($max_hmm_iter) && $max_hmm_iter > 0)
	{
		$command .= " --max-hmm-iterations=".$max_hmm_iter;
	}	
	if(isset($max_seq_count) && $max_seq_count > 0)
	{
		$command .= " --maxnumseq=".$max_seq_count;
	}	
	if(isset($max_seq_length) && $max_seq_length > 0)
	{
		$command .= " --maxseqlen=".$max_seq_length;
	}	
	
	$command .= " --force";
	$command .= " > console_out.txt 2>&1";
	
	clean_files($progr_dir,$out_file);
	`$command`;
	
	// Output files:
	//    out.???
	//    dist_matr_out.txt
	//    guide_tree_out.txt
	//    cluster_out.txt
	$output = "";
	$output .= read_file('console_out.txt');
	$output = str_replace("file ../../progr/input.txt", "file or input", $output);
	$output .= "<br/>";
	
	if(file_exists($progr_dir.$out_file)){
		$output .= "<h3>Подредена секвенция:</h3>";
		$output .= "<textarea name=\"ordered_seq\" rows=\"15\" cols=\"70\">";
		$output .= read_file($progr_dir.$out_file);
		$output .= "</textarea><br/>";
		$output .= "<a href=\"includes/download.php?file=".$out_file."\">Свали изходния файл</a><br/><br/>";
	}
	else{
		$output .= "<b>Неуспешно генериране на подредена секвенция. Вижте грешките по-горе.</b><br/>";
	}
	if(file_exists($progr_dir."dist_matr_out.txt")){
		$output .= "<h3>Матрица на разпределението:</h3>";
		$output .= "<textarea name=\"dist_matr\" rows=\"15\" cols=\"70\">";
		$output .= read_file($progr_dir."dist_matr_out.txt");
		$output .= "</textarea><br/>";	
		$output .= "<a href=\"includes/download.php?file=dist_matr_out.txt\">Свали матрицата на разпределението</a><br/><br/>";
	}
	if(file_exists($progr_dir."guide_tree_out.txt")){
		$output .= "<h3>Еволюционно дърво(guide-tree):</h3>";
		$output .= "<textarea name=\"guide_tree\" rows=\"15\" cols=\"70\">";
		$output .= read_file($progr_dir."guide_tree_out.txt");
		$output .= "</textarea><br/>";	
		$output .= "<a href=\"includes/download.php?file=guide_tree_out.txt\">Свали еволюционното дърво</a><br/><br/>";
	}
	if(file_exists($progr_dir."cluster_out.txt")){
		$output .= "<h3>Клъстериране:</h3>";
		$output .= "<textarea name=\"cluster\" rows=\"15\" cols=\"70\">";
		$output .= read_file($progr_dir."cluster_out.txt");
		$output .= "</textarea><br/>";	
		$output .= "<a href=\"includes/download.php?file=cluster_out.txt\">Свали клъстерирането</a><br/><br/>";
	}
	
	echo $output;
	
	/*
	$output = "<br/><br/>";
	$output .= "\$input_sequence: ".$input_sequence."<br/>";
	if(isset($in_file_content)){
		$output .= "\$in_file_content: ".$in_file_content."<br/>";
	}
	$output .= "\$hmm_checkbox: ".$hmm_checkbox."<br/>";
	$output .= "\$seq_type: ".$seq_type."<br/>";
	$output .= "\$in_file_format: ".$in_file_format."<br/>";
	$output .= "\$dealign_checkbox: ".$dealign_checkbox."<br/>";
	if(isset($pre_align_file_content)){
		$output .= "\$pre_align_file_content: ".$pre_align_file_content."<br/>";
	}
	if(isset($dist_matr_file_content)){
		$output .= "\$dist_matr_file_content: ".$dist_matr_file_content."<br/>";
	}
	$output .= "\$dist_matr_out_checkbox: ".$dist_matr_out_checkbox."<br/>";
	
	if(isset($guide_tree_file_content)){
		$output .= "\$guide_tree_file_content: ".$guide_tree_file_content."<br/>";
	}
	$output .= "\$guide_tree_out_checkbox: ".$guide_tree_out_checkbox."<br/>";
	$output .= "\$use_full_matr_checkbox: ".$use_full_matr_checkbox."<br/>";
	$output .= "\$use_full_matr_iter_checkbox: ".$use_full_matr_iter_checkbox."<br/>";
	$output .= "\$max_seq_sub_clusters: ".$max_seq_sub_clusters."<br/>";
	$output .= "\$cluster_out_checkbox: ".$cluster_out_checkbox."<br/>";
	$output .= "\$use_kimura_checkbox: ".$use_kimura_checkbox."<br/>";
	$output .= "\$dist_to_perc_checkbox: ".$dist_to_perc_checkbox."<br/>";
	$output .= "\$msa_out_order: ".$msa_out_order."<br/>";
	$output .= "\$num_iter: ".$num_iter."<br/>";
	$output .= "\$max_guidetree_iter: ".$max_guidetree_iter."<br/>";
	$output .= "\$max_hmm_iter: ".$max_hmm_iter."<br/>";
	$output .= "\$max_seq_count: ".$max_seq_count."<br/>";
	$output .= "\$max_seq_length: ".$max_seq_length."<br/>";
	
	echo $output;*/
}			

function is_checkbox_checked($checkbox_name){
	$is_checked = isset($_POST[$checkbox_name]) ? true: false;
	return $is_checked;
}

function create_file($location, $content){
	$fh = fopen($location, 'w')
		or die("can't open file");
	fwrite($fh, $content);
	fclose($fh);
}

function read_file($location){
	if (is_readable($location) && filesize($location)>0){
		$fh = fopen($location, 'r')
			or die("can't open file");
		$contents = fread($fh, filesize($location));
		fclose($fh);
		return $contents;
	}
	else{
		return "";
	}
}

function clean_files($progr_dir,$out_file){

	if(file_exists($progr_dir.$out_file)){
		unlink($progr_dir.$out_file);
	}
	if(file_exists($progr_dir."dist_matr_out.txt")){
		unlink($progr_dir."dist_matr_out.txt");
	}
	if(file_exists($progr_dir."guide_tree_out.txt")){
		unlink($progr_dir."guide_tree_out.txt");
	}
	if(file_exists($progr_dir."cluster_out.txt")){
		unlink($progr_dir."cluster_out.txt");
	}
}
?>