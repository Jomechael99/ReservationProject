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

    $('#studentType').on('change', function () {

        var id = $('#studentType option:selected').val();

        if(id != 3){
            $('#department, #organization').prop('selectedIndex', 0)
            $('#organization').empty().append("<option value=''> Choose option </option>")
        }

    })




    $('#userType').on('change', function(){

        var selected_value = $('#userType option:selected').val();
        $('.changeSelect').attr("hidden", false);

        if(selected_value == 1){ // Staff
            $('.staffSelect').prop('selectedIndex', 0);
            selectedStaff();
            $('#studentType,#division,#organization,#department').attr('readonly', true);
            $('#office').attr('readonly', false);

        }else if(selected_value == 2){
            $('.teacherSelect').prop('selectedIndex', 0);
            selectedTeacher();
            $('#studentType,#organization,#office').attr('readonly', true);
            $('#department,#division').attr('readonly', false);
        }else if(selected_value == 3){
            $('.studentSelect').prop('selectedIndex', 0);
            selectedStudent();
            $('#studentType,#division,#organization,#department').attr('readonly', false);
            $('#office').attr('readonly', true);
        }
    });
});
