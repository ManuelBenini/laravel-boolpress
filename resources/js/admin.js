
require('./bootstrap');


$().ready(function(){
    // qui si mette tutto il codice JQuery e JS che avviene dopo il carimento del DOM

    formValidator($('#postsCreateForm'));
    formValidator($('#postsEditForm'));

    function formValidator(form){
        form.submit(function(event){
            $('#error-title').hide();
            $('#error-content').hide();
            let errors = false;

            if($('#title').val().length === 0){
                $('#error-title').show('slow').text('Il titolo è un campo obbligatorio').fadeOut(5000);
                errors = true;
            }
            if($('#title').val().length < 3 && $('#title').val().length != 0){
                $('#error-title').show('slow').text('Devi inserire almeno 3 caratteri').fadeOut(5000);
                errors = true;
            }
            if($('#title').val().length > 255 && $('#title').val().length != 0){
                $('#error-title').show('slow').text('Puoi inserire massimo 255 caratteri').fadeOut(5000);
                errors = true;
            }


            if($('#content').val().length === 0){
                $('#error-content').show('slow').text('Il contenuto è un campo obbligatorio').fadeOut(5000);
                errors = true;
            }
            if($('#content').val().length < 10 && $('#content').val().length != 0){
                $('#error-content').show('slow').text('Devi inserire almeno 10 caratteri').fadeOut(5000);
                errors = true;
            }


            if(errors){
                event.preventDefault();
            }
        });

    }

})
