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
   
    $('button#submit').click(function() {
        console.log('button clicked');
        
        formData = new FormData();
        formData.set('_token', CSRF_TOKEN);
        users = new Object;
        
        // iterate across all tr (which means: iterate acrros all users)
        $('tr.userinstance').each(function(i, userinstance) {
            id = $(userinstance).attr('id');
            console.log('user-id: ' + id);
            
            users[id] = [];
            // iterate across all checkboxes in this tr (which means: iterate across all roles of the user)

            $(userinstance).find("input:checked").each( function() {
               users[id].push($(this).attr('name'));
            });
            console.log('all users: ' + JSON.stringify(users));
        });
        formData.set('users', JSON.stringify(users));
            
        $.ajax({
            url: '/admin/updateusers',
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
