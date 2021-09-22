$(function() 
{

    $('#alert_info').bind('click', function (event, arg1) 
    {
        swal({
            title: "For your information",
            text: arg1,
            //confirmButtonColor: "#2196F3",
            showConfirmButton: false,
            type: "info",
            timer: 2000
        });
    });

    $('#alert_info_2').bind('click', function (event, arg1) {
        swal({
            title: "For your information",
            text: arg1,
            confirmButtonColor: "#2196F3",
            showConfirmButton: true,
            type: "info"
        });
    });

    $('#alert_success').bind('click', function (event, arg1) 
    {
        swal({
            title: "Good job!",
            text: arg1,
           // confirmButtonColor: "#66BB6A",
            showConfirmButton: false,
            type: "success",
            timer: 1600
        });
    });

    $('#alert_error').bind('click', function (event, arg1) 
    {
        swal({
            title: "Oops...",
            text: arg1,
            //confirmButtonColor: "#EF5350",
            type: "error",
            timer: 2000
        });
    });

    $('#alert_warning').bind('click', function (event, arg1) 
    {
        swal({
            title: "Hm.. ?",
            text: arg1,
            type: "warning",
            timer: 2000
        });
    });
});
