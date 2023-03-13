$(document).ready(function () {
    $("#profileForm").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "profileProcess.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (result) {
                if (result.status == 'error') {
                    $("#alertError").html(result.msg);
                    $("#alertError").fadeIn();
                } else {
                    $("#alertSuccess").html(result.msg);
                    $("#alertSuccess").fadeIn();
                }
            },
            error: function (result) {
                console.error(result);
            }
        });
    });

    $("#passBtn").click(function () {

        $(this).addClass("active");
        $("#profileInfo").removeClass("active");
        $("#changePassForm").show();
        $("#profileForm").hide();

    });

    $("#errorPass").hide();
    $("#changePassForm").hide();

    $("#profileInfo").click(function () {

        $(this).addClass("active");
        $("#passBtn").removeClass("active");
        $("#profileForm").show();
        $("#changePassForm").hide();

    });

});