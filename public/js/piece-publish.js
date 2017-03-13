$(document).ready(function() {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    /*
     *    EXPANSION OF OPTIONAL INPUT FIELDS
     */
     
    // the ids which shall trigger expansion of optional content
    var optionals = new Array(
        "composer",
        "opus",
        "epoque",
        "instrumentation",
        "ensemble",
        "text",
        "text-lyricist",
        "text-language",
        "text-preText",
        "cantus",
        "source"
    );
    
    // expand or hide optional content when the respective id changes value
    $.each(optionals, function(index, classname){
        $('#' + classname).change(function() {
            if ( $('#' + classname).val() == "new" ) {
                $('.optional.' + classname ).show();
            }
            else {
                $('.optional.' + classname ).hide();
            }
        });
    });
    
    /*
     *     SUBMIT
     */
   
    $('button#submit').click(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
       // var formData = new FormData();        
        formData.append('_token', CSRF_TOKEN);
        
        formData.append('title', $('#title').val());
        
        formData.append('composer_id', $('#composer').val());
        formData.append('composerFirstName', $('#composer-firstName').val());
        formData.append('composerLastName', $('#composer-lastName').val());
        formData.append('composerIntalidationerName', $('#composer-interName').val());
        if ( $('#composer').val() == "new") {
            formData.append('composerImage', composerImage);
        } else {
            formData.append('composerImage', '');
        }    
        formData.append('composerBirthYear', $('#composer-birthYear').val());
        formData.append('composerBirthYearCertainty', $('#composer-birthYearCertainty').is(':checked'));
        formData.append('composerDeathYear', $('#composer-deathYear').val());
        formData.append('composerDeathYearCertainty', $('#composer-deathYearCertainty').is(':checked'));

        formData.append('composerImageDescription', $('#composer-image-description').val());
        formData.append('composerImageLicense', $('#composer-image-license').val());
        formData.append('composerImageSource',$('#composer-image-source').val());

        formData.append('opus_id', $('#opus').val());
        formData.append('opusTitle', $('#opus-title').val());

        formData.append('year', $('#year').val());
        formData.append('difficulty_id', $('#difficulty').val());

        formData.append('epoque_id', $('#epoque').val());
        formData.append('epoqueName', $('#epoque-name').val());

        formData.append('instrumentation_id', $('#instrumentation').val());
        formData.append('instrumentationNumberOfVoices', $('#instrumentation-numberOfVoices').val()); 
        formData.append('instrumentationName', $('#instrumentation-name').val());
        formData.append('ensemble_id', $('#ensemble').val());
        formData.append('ensembleName', $('#ensemble-name').val());

        formData.append('text_id', $('#text').val());
        formData.append('textTitle', $('#text-title').val());
        formData.append('textLanguage_id', $('#text-language').val());
        formData.append('textLanguageName', $('#text-language-name').val());
        formData.append('textLyricist_id', $('#text-lyricist').val());
        formData.append('textPreText_id', $('#text-preText').val());
        formData.append('textPreTextTitle', $('#text-preText-title').val());

        formData.append('cantus_id', $('#cantus').val());
        formData.append('cantusTitle', $('#cantus-title').val());    
        
        formData.append('pdf', $('#pdf')[0].files[0]);
        
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
                    window.location.replace('/piece/published/' + response.piece_id);
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
