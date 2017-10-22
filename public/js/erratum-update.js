$(document).ready(function() {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
   
    /*
     *    PACK THE DATA FOR THE AJAX-SUBMIT
     */
    
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');   
    
    /*
     *     SUBMIT
     */
   
    $('.erratum-status').on('change', function() {
		currentSelect = $(this).parents('td');
		id= $(this).parents('tr').attr('id');
		status = $(this).val();     
		console.log('Erratum update: changed status of erratum No. ' + id + ' to "' + status + '"');
		
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');   
  
    	formData = new FormData();
    	formData.set('_token', CSRF_TOKEN);
	    formData.append('id', id);
        formData.append('status', status);
  	
		$.ajax({
            url: '/board/update/erratum',
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: 'JSON',     
            data: formData,
            success: function(response){
				currentSelect.removeClass('erratum-status-submitted erratum-status-approved erratum-status-refused erratum-status-closed');
				currentSelect.addClass('erratum-status-' + response.erratumStatus);
			},
            error: function(){
            	alert('Fehler beim Speichern der Statusänderung!');    
            }
        });
   		


	});
});
