$(document).ready(function() {
	$('button#submit').click(function(){
	    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');   
  
    	var formData = new FormData();
    	formData.set('_token', CSRF_TOKEN);
	    formData.set('piece_id', $('#piece_id').val());
        formData.set('bar_number', $('#bar_number').val());
        formData.set('voice', $('#voice').val());
        formData.set('description', $('#description').val());
        formData.set('provider_email', $('#email').val());

		$.ajax({
            url: '/erratum/store',
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: 'JSON',     
            data: formData,
            success: function(response){
               if (response.status == 'error'){
                   $(".optional.errors").show();
                       $('ul.errors').empty();
                   $.each(response.errors, function (index, error) {
                       $('ul.errors').append('<li>' + error + '</li>');
                   });
               }
               if (response.status == 'success'){ // "redirect" to success page
                   alert('Vielen Dank, dass du das Erratum gemeldet hast. Wir kümmern uns darum! Wenn Du Fragen hast, schreib einfach eine Mail an mail@nun-singet-und-seid-froh.info')

					window.location.replace('/piece/show/' + response.pieceId);
               }
            },
            error: function(response){
               $(".optional.errors").show();
               $('ul.errors').empty();
               $.each(response.errors, function (index, error) {
                   $('ul.errors').append('<li>' + error + '</li>');
               });    
           }
        });
    });
});
