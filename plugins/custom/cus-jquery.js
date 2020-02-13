
$(function(){


    $("#eyepass").click(function() {
        
            var input = $("#pass");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
                $("#eyepass").html('<i class="fa fa-eye-slash"></i>');
            } else {
                input.attr("type", "password");
                $("#eyepass").html('<i class="fa fa-eye"></i>');
            }

    });

    $("#eyecpass").click(function() {
        
            var input = $("#conpass");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
                $("#eyecpass").html('<i class="fa fa-eye-slash"></i>');
            } else {
                input.attr("type", "password");
                $("#eyecpass").html('<i class="fa fa-eye"></i>');
            }

    });


    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight:'TRUE',
        autoclose: true
    });

    $('.select2').select2();
    
})
