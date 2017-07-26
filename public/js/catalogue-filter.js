$(document).ready(function(){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $("select").change(function(){
        console.log('selected pretext: ' + $('#pretexts').val());
        $.ajax({
            url: '/catalogue-filter',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                title: $("#titles").val(), 
                composer_id: $("#composers").val(),
                lyricist_id: $("#lyricists").val(),
                text_id: $('#text').val(),
                difficulty_id: $("#difficulties").val(),
                numberOfVoices: $("#numberOfVoices").val(),
                ensemble_id: $("#ensembles").val(),
                instrumentation_id: $("#instrumentations").val(),
                epoque_id: $("#epoques").val(),
                cantus_id: $("#cantusses").val(),
                language_id: $("#languages").val(),
                pretext_id: $("#pretexts").val(),
                opus_id: $("#opusses").val()
            },
            dataType: 'JSON',
            success: function(response) {
                $(".pieces").empty();
                
                // update the counter
                $('#counter-number').empty();
                $('#counter-number').append(response.count);                
                
                
                // update the selects
                
                // the title-select
                $("#titles").empty();
                $("#titles").append("<option value=''>" + "</option>");

                $.each(response.titles, function( index, title )  {
                    console.log("Titel: " + title + ", " + response.selected_title);
                    if ( title == response.selected_title){
                        var select = "selected";
                    }
                    else {
                        var select = "";
                    }
                    
                    $("#titles").append('<option value="' + title + '"' + select + '>' + title + "</option>");
                });

                // the composers select
                console.log("Komponisten: " + response.composers);
                $("#composers").empty();
                $("#composers").append("<option value=''></option>");              
                
                $.each(response.composers, function( index, composer )  {
                    if ( composer.id == response.selected_composer_id){
                        var select = "selected";
                    }
                    else {
                        var select = "";
                    }
                    
                    $("#composers").append('<option value="' + composer.id + '"' + select + ">" + composer.string + "</option>");
                });
                    
                // the opusses select
                console.log("Opus: " + response.selected_opus_id);
                $("#opusses").empty();                
                $("#opusses").append("<option value=''>" + "</option>");              
                $.each(response.opusses, function( index, opus )  {
                    if ( opus.id == response.selected_opus_id){
                        var select = "selected";
                    }
                    else {
                        var select = "";
                    }
                    
                    $("#opusses").append('<option value="' + opus.id + '"' + select + ">" + opus.title + "</option>");
                });
                
                // the epoques select
                console.log("Epoque: " + response.selected_epoque_id);
                $("#epoques").empty();                
                $("#epoques").append("<option value=''></option>");              
                $.each(response.epoques, function( index, epoque )  {
                    if ( epoque.id == response.selected_epoque_id){
                        var select = "selected";
                    }
                    else {
                        var select = "";
                    }
                    
                    $("#epoques").append('<option value="' + epoque.id + '"' + select + ">" + epoque.name + "</option>");
                });

                // the difficulties select
                console.log("Difficulty: " + response.selected_difficulty_id);
                $("#difficulties").empty();                
                $("#difficulties").append("<option value=''></option>");              
                $.each(response.difficulties, function( index, difficulty )  {
                    if ( difficulty.id == response.selected_difficulty_id){
                        var select = "selected";
                    }
                    else {
                        var select = "";
                    }
                    
               $("#difficulties").append('<option value="' + difficulty.id + '"' + select + ">" + difficulty.name + "</option>");
                });

                // the numberOfVoices select
                console.log("Number of Voices: " + response.selected_numberOfVoices);
                $("#numberOfVoices").empty();                
                $("#numberOfVoices").append("<option value=''></option>");              
                $.each(response.numberOfVoices, function( index, numberOfVoices )  {
                    if ( numberOfVoices == response.selected_numberOfVoices){
                        var select = "selected";
                    }
                    else {
                        var select = "";
                    }
                    
                    $("#numberOfVoices").append('<option value="' + numberOfVoices + '"' + select + ">" + numberOfVoices + "</option>");
                });

                // the ensembles select
                console.log("Ensemble: " + response.selected_ensemble_id);
                $("#ensembles").empty();                
                $("#ensembles").append("<option value=''></option>");              
                $.each(response.ensembles, function( index, ensemble )  {
                    if ( ensemble.id == response.selected_ensemble_id){
                        var select = "selected";
                    }
                    else {
                        var select = "";
                    }
                    
                    $("#ensembles").append('<option value="' + ensemble.id + '"' + select + ">" + ensemble.name + "</option>");
                });

                // the instrumentations select
                console.log("Instrumentation: " + response.selected_instrumentation_id);
                $("#instrumentations").empty();                
                $("#instrumentations").append("<option value=''></option>");              
                $.each(response.instrumentations, function( index, instrumentation )  {
                    if ( instrumentation.id == response.selected_instrumentation_id){
                        var select = "selected";
                    }
                    else {
                        var select = "";
                    }
                    
                    $("#instrumentations").append('<option value="' + instrumentation.id + '"' + select + ">" + instrumentation.name + "</option>");
                });

                // the cantusses select
                console.log("Cantus: " + response.selected_cantus_id);
                $("#cantusses").empty();                
                $("#cantusses").append("<option value=''></option>");              
                $.each(response.cantusses, function( index, cantus )  {
                    if ( cantus.id == response.selected_cantus_id){
                        var select = "selected";
                    }
                    else {
                        var select = "";
                    }
                    
                    $("#cantusses").append('<option value="' + cantus.id + '"' + select + ">" + cantus.title + "</option>");
                });
                
                // the languages select
                console.log("Language: " + response.selected_language_id);
                $("#languages").empty();                
                $("#languages").append("<option value=''></option>");              
                $.each(response.languages, function( index, language )  {
                    if ( language.id == response.selected_language_id){
                        var select = "selected";
                    }
                    else {
                        var select = "";
                    }
                    
                    $("#languages").append('<option value="' + language.id + '"' + select + ">" + language.name +  "</option>");
                });                

                // the pretexts select
                console.log("pretext: " + response.selected_pretext_id);
                $("#pretexts").empty();   
                $("#pretexts").append("<option value=''></option>");              
                $.each(response.pretexts, function( index, pretext )  {
                    if ( pretext.id == response.selected_pretext_id){
                        var select = "selected";
                    }
                    else {
                        var select = "";
                    }
                    
                    $("#pretexts").append('<option value="' + pretext.id + '"' + select + ">" + pretext.title +  "</option>");
                });                


    /*
     *  LISTING THE PIECES 
     */
                $.each(response.pieces, function( index, piece ) {
                   // create a div for each piece
                   $(".pieces").append("\
                   <div class='catalogue-item micro-box micro-shadow'>\
                        <div class='composer-name'>" + piece.composer + "</div>\
                        <div class='piece-title'><a href=" + piece['link'] + ">" + piece['title'] + "</a></div>\
                        <div class='informations'>\
                            <ul class='informations'>\
                                <li class='ensemble'>" + piece['ensemble'] + "</li>\
                                <li class='numberOfVoices'>" + piece['numberOfVoices'] +"-stimmig</li>\
                                <li class='instrumentation'>" + piece['instrumentation']['name'] + "</li>\
                                <li class='difficulty'>" + piece['difficulty']['name'] + "</li>\
                                <li class='epoque'>" + piece['epoque']['name'] + "</li>\
                                <li class='language'>" + piece['language'] + "</li>\
                            </ul>\
                        </div>\
                   </div>\
                   ");                
                });
            }
       });
            
     }); 
});

