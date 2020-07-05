$(document).ready(function(){


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
                    alert("Student Successfully Added");
                }else{

                    jQuery.each(response.errors, function(key, value){
                        jQuery('.alert-danger').show();
                        jQuery('.alert-danger').append('<p>'+value+'</p>');
                    });

                }

            }
        });
    }

});
