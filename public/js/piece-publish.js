$(document).ready(function() {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    /*
     *    EXPANSION OF OPTIONAL INPUT FIELDS AND ADDITIONAL FIELDS
     */
     
    // the ids which shall trigger expansion of optional content
    var optionals = new Array(
        "composer",
        "opus",
        "epoque",
        "instrumentation",
        "ensemble",
        "text",
        "lyricist",
        "text-language",
        "preText",
        "preText-language",
        "pretextLyricist",
        "cantus"
    );
    
    // expand or hide optional content when the respective id changes value
    $.each(optionals, function(index, classname){
        $('select#' + classname).change(function() {
            if ( $('select#' + classname).val() == "new" ) {
               $('.optional.' + classname).show();
            }
            else {
               $('.optional.' + classname ).hide();
            }
        });
    });
    
    // special case for source, since multiple sources can be added dynamically    
    $(document).on('change', '.source-select', function() {
            var parentID = $(this).parents('.source-instance').attr('id');
            console.log('source-select has been set to new in ' + parentID );
            if ( $('#' + parentID).find('.source-select').val() == "new"){
                $('#' + parentID).find('.optional').show();    
            }
            else {
                $('#' + parentID).find('.optional').hide();
            }
    });

    // add additional input fields for multiple sources
    $('button.add-source').click(function() {
        $('.additional-source').append($('.source-container').html()); 
        $('.source-instance').each(function(index) {
            console.log('source instance no.' + index);
            $(this).attr('id', 'source-instance-no-' + index);
        });
    });
    
    /*
     *    PACK THE DATA FOR THE AJAX-SUBMIT
     */
    
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');   
    formData = new FormData();
    formData.set('_token', CSRF_TOKEN);


    /*
     *    CROPPING OF IMAGES
     */
     
    // save the raw image to the temp directory, display and load the cropper on it
    var cropImage = function(name){
        $(document).on('change','#' + name + '-raw-image', function(){
            formData = new FormData();
            formData.set('raw-image', $('#' + name + '-raw-image')[0].files[0]);

            // save the raw image via ajax
            $.ajax({
                url: '/image/raw',
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'JSON',     
                data: formData,
                success: function(response){    
                    // display the raw image
                    $('#' + name + '-raw-image-container').empty();
                    $('#' + name + '-raw-image-container').append($('<img></img>').attr({ 
                        src : '/storage/temp/' + response.path,
                        width: '100%',
                        id: name + '-raw-image' })
                    .addClass("center-block"));
                    console.log('Raw image uploaded with filename ' + response.path);
                   
                    //load the cropper
                    $("img#" + name + "-raw-image").cropper({
                        aspectRatio: 1 / 1,
                        crop: function(e) {
                            // attach the image to the submit formData
                            $("img#" + name + "-raw-image").cropper('getCroppedCanvas').toBlob(function(blob){  
                                formData.set( name + 'Image', blob);
                            });
                            
                            console.log('crop area updated.');
                            console.log("x: " + e.x);
                            console.log("y: " + e.y);
                            console.log("width: " + e.width);
                            console.log("height: " + e.height);
                        },
                        zoomable: false,
                        scalable: false,
                        movable: false,
                        background: true,
                        viewMode: 1,
                    });                   
                },
                error: function(){
                    alert('Fehler beim Upload der Datei!');
                }
            }); 
        });           
   };
   
   cropImage('composer');
   cropImage('lyricist');
   cropImage('pretextLyricist');
    
    /*
     *     SUBMIT
     */
   
    $('button#submit').click(function(){
        formData.set('editionNumber', $('#editionNumber').val());
        formData.set('title', $('#title').val());
        formData.set('composer_id', $('#composer').val());
        formData.set('composerFirstName', $('#composer-firstName').val());
        formData.set('composerLastName', $('#composer-lastName').val());
        formData.set('composerInterName', $('#composer-interName').val());            
  
        formData.set('composerBirthYear', $('#composer-birthYear').val());
        formData.set('composerBirthYearCertainty', $('#composer-birthYearCertainty').is(':checked'));
        formData.set('composerDeathYear', $('#composer-deathYear').val());
        formData.set('composerDeathYearCertainty', $('#composer-deathYearCertainty').is(':checked'));

        formData.set('composerImageDescription', $('#composer-image-description').val());
        formData.set('composerImageLicense', $('#composer-image-license').val());
        formData.set('composerImageSource',$('#composer-image-source').val());

        formData.set('opus_id', $('#opus').val());
        formData.set('opusTitle', $('#opus-title').val());

        formData.set('year', $('#year').val());
        formData.set('difficulty_id', $('#difficulty').val());

        formData.set('epoque_id', $('#epoque').val());
        formData.set('epoqueName', $('#epoque-name').val());

        formData.set('instrumentation_id', $('#instrumentation').val());
        formData.set('instrumentationNumberOfVoices', $('#instrumentation-numberOfVoices').val()); 
        formData.set('instrumentationName', $('#instrumentation-name').val());
        formData.set('ensemble_id', $('#ensemble').val());
        formData.set('ensembleName', $('#ensemble-name').val());

        formData.set('text_id', $('#text').val());
        formData.set('textTitle', $('#text-title').val());
        formData.set('textLanguage_id', $('#text-language').val());
        formData.set('textLanguageName', $('#text-language-name').val());
        formData.set('lyricist_id', $('#lyricist').val());
        
        formData.set('lyricistFirstName', $('#lyricist-firstName').val());
        formData.set('lyricistLastName', $('#lyricist-lastName').val());
        formData.set('lyricistInterName', $('#lyricist-interName').val());            
  
        formData.set('lyricistBirthYear', $('#lyricist-birthYear').val());
        formData.set('lyricistBirthYearCertainty', $('#lyricist-birthYearCertainty').is(':checked'));
        formData.set('lyricistDeathYear', $('#lyricist-deathYear').val());
        formData.set('lyricistDeathYearCertainty', $('#lyricist-deathYearCertainty').is(':checked'));

        formData.set('lyricistImageDescription', $('#lyricist-image-description').val());
        formData.set('lyricistImageLicense', $('#lyricist-image-license').val());
        formData.set('lyricistImageSource',$('#lyricist-image-source').val());        
        
        formData.set('textPreText_id', $('#text-preText').val());
        formData.set('textPreTextTitle', $('#text-preText-title').val());

        formData.set('cantus_id', $('#cantus').val());
        formData.set('cantusTitle', $('#cantus-title').val());    
        
        formData.set('pdf', $('#pdf')[0].files[0]);
        formData.set('midi', $('#midi')[0].files[0]);
        formData.set('sourcecode', $('#sourcecode').val());
        
        var sources = new Array();
        
        // add one source-object per each source to the formData
        $('.source-instance').each(function(index){            
            
            var auxObject = {};
            auxObject["id"] = $(this).find(".source-select").val();
            auxObject["title"] = $(this).find(".source-title").val();   
            auxObject["editors"] = $(this).find(".source-editor").val();
            auxObject["year"] = $(this).find(".source-year").val();           
            auxObject["publisher"] = $(this).find(".source-publisher").val();           
            auxObject["publisherAddress"] = $(this).find(".source-publisherAddress").val();
            auxObject["url"] = $(this).find(".source-url").val();
            auxObject["comment"] = $(this).find(".source-comment").val();
            auxObject["license"] = $(this).find(".source-license").val();
            auxObject["isPubliclyAvailable"] = $(this).find(".source-available").is(':checked');
  
            formData.set('source-' + index, JSON.stringify(auxObject));
            formData.set('source-scan-' + index, $(this).find(".source-scan")[0].files[0]);
            formData.set('sourceCount', index);
        });

        // convert array of objects into JSON-string
        //formData.set('sources', JSON.stringify(sources));
        
        $.ajax({
            url: '/piece/store',
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
                   window.location.replace('/piece/published/' + response.piece_editionNumber);
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
