$(document).ready(function(){


    $( document ).on( 'focus', ':input', function(){
        $( this ).attr( 'autocomplete', 'off' );
    });

    $('#form_submit').on('click', function(){
        registration_submit();
    });

    function registration_submit(){
        $.ajax({
            type:"POST",
            url: '/StudentRegister',
            data: $('#studentForm').serialize(), // get all form field value in serialize form
            success: function(response){

                if(response.status == "success"){
                    Swal.fire({
                        icon: 'success',
                        title: 'User successfully Created',
                        text: 'you can now login...',
                    }).then(function(){
                        location.reload();
                    })
                }else{

                    jQuery.each(response.errors, function(key, value){
                        jQuery('.alert-danger').show();
                        jQuery('.alert-danger').append('<p>'+value+'</p>');
                    });

                }

            }
        });
    }
    $('#department').on('change' ,function(){

        var id = $('#department option:selected').val();
        var selected_value = $('#userType option:selected').val();
        
        if(selected_value != 2){
            $.ajax({

                type:"GET",
                url: '/viewOrganization/' + id,
                success: function(data) {
                    $('#organization').empty().append("<option value=''> Choose option </option>")
                    $('#organization').append(data.option);
                }
            });
        }else{

        }




    });

});
