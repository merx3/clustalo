<div id="input_wrapper">
	<div style="font-size: 18pt; padding-top: 30px;	padding-bottom: 15px;">Входни данни<a style="padding-left:20px; font-size:12pt" href="home.php?help">Помощ</a></div>

	<form id="input" method="post" action="/home.php" enctype="multipart/form-data">

		<div class="WebtoolsTitle"><h3>Входяща секвенция (<a href="javascript:toggleMe('seq_in');">show/hide</a>)</h3> </div>
		<div id="seq_in" class="WebtoolsDesc">
				<textarea name="ta_sequence" rows="10" cols="70"></textarea>
				<br/>
				или <br/>
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
				Изберете файл за качване: <input name="upl_in" type="file" /><br/><br/>
				<b>Настройки на вход</b><br/>
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
				HMM файл: <input name="hmm_file_in" type="file"></input><br/>
				Тип секвенция: 
				<select name="seq_type">
					<option selected value="auto">Auto</option>
					<option value="protein">Protein</option>
					<option value="rna">RNA</option>
					<option value="dna">DNA</option>
				</select><br/>
				Формат на файла с входни данни:
				<select name="in_file_format">
					<option selected value="auto">Auto</option>
					<option value="fasta">Fasta /A2M</option>
					<option value="clustal">Clustal </option>
					<option value="msf">Msf</option>
					<option value="phylip">Phylip </option>
					<option value="selex">Selex</option>
					<option value="stockholm">Stockholm</option>
					<option value="vienna">Vienna</option>
				</select><br/>
				De-alignment на входни данни: <input name="dealign" type="checkbox"></input><br/>
				Pre-aligned файл с множество секвенции(незадължително):<br/> 
					<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input name="pre_align_in1" type="file" /><br/>
				Pre-aligned файл с множество секвенции(допълнителен, незадължително):<br/> 
					<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
					&nbsp;&nbsp;&nbsp;&nbsp;<input name="pre_align_in2" type="file" /><br/>
				Пропусни проверка за коректност на профила: <input name="check_corrrect_prof" type="checkbox"></input><br/>
				
		</div>	
		
		<div class="WebtoolsTitle"><h3>Клъстериране (<a href="javascript:toggleMe('clust');">hide/show</a>)</h3></div>
		<div id="clust" class="WebtoolsDesc">
				Файл с готова матрица на разстоянията: <br/> 					
					<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
					&nbsp;&nbsp;&nbsp;&nbsp; <input name="dist_matr_in" type="file" /><br/>
				Файл с готово еволюционно дърво:<br/>
					<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
					&nbsp;&nbsp;&nbsp;&nbsp; <input name="guide_tree_in" type="file" /><br/>
				Използване на пълна матрица на разстоянията за изчисленията на еволюционното дърво (бавно): <input name="use_full_matr" type="checkbox"></input><br/>
				Използване на пълна матрица на разстоянията за изчисления при итерации на еволюционното дърво: <input name="use_full_matr_iter" type="checkbox"></input><br/>
				Максимален брой секвенции в под-клъстери: <input name="max_seq_sub_clusters"  type="number" value=0 min=0></input><br/>
				Използване на корекция на разстоянието Kimura за подредени секвенции: <input name="use_kimura" type="checkbox"></input><br/>
				Превръщане на разстояния в проценти: <input name="dist_to_perc" type="checkbox"></input><br/>
		</div>
		
		<div class="WebtoolsTitle"><h3>Настройки на изхода (<a href="javascript:toggleMe('align_out');">hide/show</a>)</h3></div>
		<div id="align_out" class="WebtoolsDesc">				
				Формат на изходния MSA файл и файлово разширение по подразбиране:</br>
				&nbsp;&nbsp;&nbsp;&nbsp;<select name="out_file_format">
					<option selected value="fasta">Fasta(.fasta)</option> 
					<option value="clustal">Clustal(.aln)</option>
					<option value="msf">Msf(.msf)</option>
					<option value="phylip">Phylip(.phy)</option>
					<option value="selex">Selex(.slx)</option>
					<option value="stockholm">Stockholm(.sth)</option>
					<option value="vienna">Vienna(.vie)</option>					
				</select><br/>
				Задаване на друго файлово разширение: <input name="out_file_ext" style="width: 50px;" type="text"></input><br/>
				
				Подредба на MSA изхода<select name="msa_out_order">
					<option selected value="none"></option> 
					<option value="input-order">ред на входа /A2M</option>
					<option value="tree-order">ред на дървото</option>
				</select><br/>
				Показване на еволюционно дърво в резултата: <input name="guide_tree_out" type="checkbox"></input><br/>
				Показване на изхода от клъстериране в резултата: <input name="cluster_out" type="checkbox"></input><br/>
				Показване на матрица на разстоянията в резултата: <input name="dist_matr_out" type="checkbox"></input><br/>
		</div>
		
		<div class="WebtoolsTitle"><h3>Итерации и ограничения (<a href="javascript:toggleMe('iter');">hide/show</a>)</h3></div>
		<div id="iter" class="WebtoolsDesc">
			Брой итерации: <input name="num_iter"  type="number" value=0 min=0></input><br/>
			Максимален брой итерации на еволюционното дърво: <input name="max_guidetree_iter"  type="number" value=0 min=0></input><br/>
			Максимален брой HMM итерации : <input name="max_hmm_iter"  type="number" value=0 min=0></input><br/>
			Максимален брой секвенции : <input name="max_seq_count"  type="number" value=0 min=0></input><br/>
			Максимална дължина на секвенция : <input name="max_seq_length"  type="number" value=0 min=0></input><br/>
		</div>
								
		<br/>
		<input type="submit" value="Изпращане"></input>
	</form>
</div>