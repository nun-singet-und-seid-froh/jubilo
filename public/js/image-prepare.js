$(document).ready(function(){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).on('change','#composer-image-raw', function(){

        var formData = new FormData();
        formData.append('_token', CSRF_TOKEN);
        formData.append('composer-image-raw', $('#composer-image-raw')[0].files[0]);

        $.ajax({
            url: '/image/prepare',
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: 'JSON',     
            data: formData,
            success: function(response){
                $('#composer-image-container').empty();
                $('#composer-image-container').append($('<img></img>')
                .attr({ src : '/storage/temp/' + response.path,
                        width: '100%',
                        id: 'composer-image' })
                .addClass("center-block")
                );
                
                // load the cropper on the image
                $("#composer-image").cropper({
                    aspectRatio: 1 / 1,
                    crop: function() {
    
                    },
                    zoomable : false  ,
                    scalable : false,
                    movable : false,
                    background : true,
                    viewMode : 1,
                    built : function(){
                        $(this).cropper('getCroppedCanvas').toBlob(function (blob) {
                            console.log("Composer Image Cropped");
                            
                        formData = new FormData();
                        formData.append('composerImage', blob);
                        console.log(formData);                            
                        });
                    }
                });

                
                
            },
            error: function(){
                alert('Die hochgeladene Datei darf nicht größer als 2 MB sein.');
            }  
        });
    });
})    
