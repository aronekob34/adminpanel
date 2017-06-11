$(function() {
	
    var ul = $('#be-file-upload ul');
    var max_upload_limit = $('#be-file-upload-max-limit').val();
    
    $('#drop a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#be-file-upload').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
        	
        	
        	var count_updated = parseInt($('#be-file-upload-count').val()) + 1;
        	
        	
        	if(count_updated > max_upload_limit) {
        		
        		alert('You cannot upload more than ' + max_upload_limit + ' images!');
        		
        	} else {
        		
        		var count_updated_general = parseInt($('#be-file-upload-count-general').val()) + 1;
        		$('#be-file-upload-count-general').val(count_updated_general);
        		
	            var tpl = $('<li class="working" id="be-file-upload-li-' + count_updated_general + '"><input type="text" value="0" data-width="48" data-height="48"'+
	                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p>'+
	                '<span></span></li>');
	            
	
	            // Append the file name and file size
	            tpl.find('p').text(data.files[0].name)
	                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');
	
	            // Add the HTML to the UL element
	            data.context = tpl.appendTo(ul);
	
	            // Initialize the knob plugin
	            tpl.find('input').knob();
	
	            // Listen for clicks on the cancel icon
	            tpl.find('span').click(function() {
	            	
	            	var count_updated_remove = parseInt($('#be-file-upload-count').val()) - 1;
	            	$('#be-file-upload-count').val(count_updated_remove);
	            	
	            	var remove_file_name = '';
	            	var new_file_names_str = '';
	            	
	            	var file_names = $('#be-file-upload-name').val().split($('#be-file-upload-imagename-separator').val());
	            	var file_name_index_ar = $(this).parent('li').attr('id').split('li-');
	            	var file_name_index = file_name_index_ar[file_name_index_ar.length-1];
	            	
	            	
	            	var file_name_sp, file_name_remove_temp;
	            	for(var i = 1; i < file_names.length; i++) {
	            		file_name_sp = file_names[i].split('_');

	            		if(file_name_sp[0] != file_name_index) {
	            			new_file_names_str = new_file_names_str + $('#be-file-upload-imagename-separator').val() + file_names[i];
	            		} else {
	            			file_name_remove_temp = file_names[i].split(file_name_index + '_');
	            			remove_file_name = file_name_remove_temp[1];
	            		}
	            	}

	            	console.log('remove file name : ' + remove_file_name);
	            	
	            	$('#be-file-upload-name').val(new_file_names_str);
	            	
	                if(tpl.hasClass('working')){
	                    jqXHR.abort();
	                }
	                
	                
	                tpl.next("img").remove();
	                //removePreviewImage();
	                
	                tpl.fadeOut(function(){
	                    tpl.remove();
	                });
	                

	                
	                $.ajax({
	                    url: $('#be-home-url').val() + 'file_upload/remove_temp_file/',
	                    global: false,
	                    type: "POST",
	                    data: ({temp_file_name : remove_file_name}),
	                    dataType: "HTML",
	                    async:true,
	                    success: function(msg){
	                    	//alert(msg);
	                    	return;
	                    }
	                 });
	
	            });
	
	            // Automatically upload the file once it is added to the queue
	            var jqXHR = data.submit().success(function(result, textStatus, jqXHR){

	            	var json = JSON.parse(result);
	            	var status = json['status'];

	            	if(status == 'error') {
	            		data.context.addClass('working');
	            		data.context.addClass('error');
		            	setTimeout(function(){
		            		data.context.fadeOut('slow');
		            	}, 2000);
	            	} else if(status == 'success') {
	            		$('#be-file-upload-count').val(count_updated);
	            		var new_file_name = count_updated_general + '_' + $('#be-admin-user-id').val() + '_' + data.files[0].name;
	            		var new_content = $('#be-file-upload-name').val() + $('#be-file-upload-imagename-separator').val() + new_file_name;
	            		$('#be-file-upload-name').val(new_content);
	            		previewImage(data);
	            	}
	            });
        	}
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();

            if(progress == 100) {
                data.context.removeClass('working');
            }
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        }

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }
    
    // Custom - Preview Image
    function previewImage(pData) {
    	var reader = new FileReader();
    	reader.readAsDataURL(pData.files[0]);          
    	reader.onload = function (e) {
    		$("#be-file-upload li").last().after("<img src='"+e.target.result+"' width=300 height=auto class='imgUploading'>");
    	}
    }
    
    function removePreviewImage() {
    	$("#be-file-upload ul img").last().remove();
    }
});