function toggleMe(a){
	var e=document.getElementById(a);
	if(!e)return true;
	if(e.style.display=="none"){
		
		e.style.display="block";
	}
	else{
		e.style.display="none";
	}
	return true;
}
		
 $(document).ready(function() {  
		$('#result').hide();
		prepareAjax();
		//alert("Document Ready!");
    });

function prepareAjax(){
	 // variable to hold ajax request
	var request;
	// bind to the submit event of our form
	$("#input").submit(function(event){
		// abort any pending request
		if (request) {
			request.abort();
		}
		// setup some local variables
    	var $form = $(this);
		// let's select and cache all the fields
		var $inputs = $form.find("input, select, button, textarea");
		// serialize the data in the form
		var serializedData = $form.serialize();
		
	   // let's disable the inputs for the duration of the ajax request
		// Note: we disable elements AFTER the form data has been serialized.
		// Disabled form elements will not be serialized.
		$inputs.prop("disabled", true);
		
		// prevent default posting of form
		event.preventDefault();
				
		var file_input_names = new Array("upl_in", "pre_align_in1", "pre_align_in2", "dist_matr_in", "hmm_file_in", "guide_tree_in");
		read_all_files(file_input_names);
		
				
		function read_all_files(inputs){
			if(inputs.length == 0){
				continue_ajax_after_file_reading();
				return;
			}
			
			var input_name = inputs.pop();
			var files = $("[name='" + input_name +"']")[0].files;

			if(files.length > 0){
				var f = files[0];
				if (f) {	
					var reader = new FileReader();
					reader.onloadend = function(evt) {
						// file is loaded
						result = evt.target.result;
						var content = encodeURIComponent(result);
						serializedData += ("&" + input_name + "=" + content);
						read_all_files(inputs);
					};		
					
					console.log("reading!");
					reader.readAsText(f);
				} else { 
					alert("Error! Could not read file.");
				}
			}
			else{
				// file input was not uploaded(has no file specified), continue reading other file inputs 
				read_all_files(inputs);
			}
		}

		function continue_ajax_after_file_reading(){
			console.log(serializedData);
			
			// fire off the request to /form.php
			request = $.ajax({
				beforeSend: function(){    
					$('#result').show();
					$('#wait_div').show(); 
					$("#input_wrapper").hide();
				},
				url: "/clustalo/web/includes/calculate.php",
				type: "post",
				data: serializedData
			});

			// callback handler that will be called on success
			request.done(function (response, textStatus, jqXHR){
				$('#result_output').html(response);
				$('#wait_div').hide();
			});

			// callback handler that will be called on failure
			request.fail(function (jqXHR, textStatus, errorThrown){
				// log the error to the console
				console.error(
					"The following error occured: "+
					textStatus, errorThrown
				);
			});

			// callback handler that will be called regardless
			// if the request failed or succeeded
			request.always(function () {
				// reenable the inputs
				$inputs.prop("disabled", false);
			});
		}
	});
}
