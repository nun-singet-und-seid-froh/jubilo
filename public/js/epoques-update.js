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
   
    $('button#submit').on('click', function() {
        console.log('Epoques update: submit-button clicked');
        
        formData = new FormData();
        formData.set('_token', CSRF_TOKEN);
        users = new Object;
        
        // iterate across all tr (which means: iterate acrros all epoques)
        var epoques = {};
        $('tr.epoqueinstance').each(function(i,epoqueinstance) {
            id = $(epoqueinstance).attr('id');
            console.log('epoque-id: ' + id);

            var epoque = {};
            $(epoqueinstance).find('input').each( function() {
                epoque[$(this).attr('name')] = $(this).val();
            });
            
            $(epoqueinstance).find('select').each(function() {
                epoque[$(this).attr('name')]= $(this).val();
            });        

            epoques[id] = epoque;
        });

        console.log('all epoques: ' + JSON.stringify(epoques));
        formData.set('epoques', JSON.stringify(epoques));
            
        $.ajax({
            url: '/board/epoques/update',
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
               if (response.status == 'success'){
                   alert('Änderungen gespeichert');
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
