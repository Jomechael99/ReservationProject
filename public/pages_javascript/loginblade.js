$(document).ready(function(){

    function selectedStaff(){
        $("#studentType > option").each(function() {
            if($(this).val() == ""){

            }else{
                $(this).attr('disabled', true);
            }
        })
        $("#division > option").each(function() {
            if($(this).val() == ""){

            }else{
                $(this).attr('disabled', true);
            }
        });
        $("#organization > option").each(function() {
            if($(this).val() == ""){

            }else{
                $(this).attr('disabled', true);
            }
        });

        $("#department > option").each(function() {
            if($(this).val() == ""){

            }else{
                $(this).attr('disabled', true);
            }
        });

           /* $('#studentType , #division , #organization , #department option:selected').attr("disabled", true);*/

        $('#office > option').each(function(){
            if($(this).val() == ""){

            }else{
                $(this).attr('disabled', false);
            }
        })
    }

    function selectedTeacher(){

        $('#office > option').each(function(){
            if($(this).val() == ""){

            }else{
                $(this).attr('disabled', true);
            }
        })

        $("#studentType > option").each(function() {
            if($(this).val() == ""){

            }else{
                $(this).attr('disabled', true);
            }
        })

       /* $("#organization > option").each(function() {
            if($(this).val() == ""){

            }else{
                $(this).attr('disabled', true);
            }
        });*/


        $("#division > option").each(function() {
            if($(this).val() == ""){

            }else{
                $(this).attr('disabled', false);
            }
        });

        $("#department > option").each(function() {
            if($(this).val() == ""){

            }else{
                $(this).attr('disabled', false);
            }
        });


    }

    function selectedStudent(){
       /* $('#office').hide();
        $('#studentType').show();
        $('#division').show();
        $('#organization').show();
        $('#department').show();*/
        $('#office > option').each(function(){
            if($(this).val() == ""){

            }else{
                $(this).attr('disabled', true);
            }
        })
        $('#studentType > option').each(function(){
            if($(this).val() == ""){

            }else{
                $(this).attr('disabled', false);
            }
        })
        $('#division > option').each(function(){
            if($(this).val() == ""){

            }else{
                $(this).attr('disabled', false);
            }
        })
        $('#organization > option').each(function(){
            if($(this).val() == ""){

            }else{
                $(this).attr('disabled', false);
            }
        })
        $('#department > option').each(function(){
            if($(this).val() == ""){

            }else{
                $(this).attr('disabled', false);
            }
        })
    }

    $('.changeSelect').attr("hidden", true);

    $('#userType').on('change', function(){

        var selected_value = $('#userType option:selected').val();
        $('.changeSelect').attr("hidden", false);
        $('#studentForm').trigger('reset');

        if(selected_value == 1){ // Staff
            selectedStaff();
            $('#studentType,#division,#organization,#department').attr('readonly', true);
            $('#office').attr('readonly', false);

        }else if(selected_value == 2){
            selectedTeacher();
            $('#studentType,#organization,#office').attr('readonly', true);
            $('#department,#division').attr('readonly', false);
        }else if(selected_value == 3){
            selectedStudent();
            $('#studentType,#division,#organization,#department').attr('readonly', false);
            $('#office').attr('readonly', true);
        }
    });
});
