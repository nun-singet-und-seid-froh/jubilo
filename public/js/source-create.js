$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('button#submit').click(function () {
        formData = new FormData();
        
        formData.set("title", $(".source-title").val());
        formData.set("editors", $(".source-editor").val());
        formData.set("year", $(".source-year").val());
        formData.set("publisher", $(".source-publisher").val());
        formData.set("publisherAddress", $(".source-publisherAddress").val());
        formData.set("url", $(".source-url").val());
        formData.set("comment", $(".source-comment").val());
        formData.set("license", $(".source-license").val());
        formData.set("isPubliclyAvailable", $(".source-available").is(':checked'));
        formData.set('scan', $(".source-scan")[0].files[0]);

    $.ajax({
    url: '/board/store/source',
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: 'JSON',
            data: formData,
            success: function (response) {
                if (response.status === 'error') {
                    $(".optional.errors").show();
                    $('ul.errors').empty();
                    $.each(response.errors, function (index, error) {
                        $('ul.errors').append('<li>' + error + '</li>');
                    });
                }
                if (response.status === 'success') { // "redirect" to success page
                    window.location.replace('/board/created/source');
                }
            },
            error: function (response) {
                $(".optional.errors").show();
                $('ul.errors').empty();
                $.each(response.errors, function (index, error) {
                    $('ul.errors').append('<li>' + error + '</li>');
                });
            }
        });
    });
});