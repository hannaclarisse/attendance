$(document).ready(function () {
    $("#registerSpinner").hide();
    $("#fPSpinner").hide();
    $("#errorAlert").hide();
    $("#errorAlertFP").hide();
    $("#successAlertFP").hide();

    $("#loginForm").submit(function (event) {
        event.preventDefault();
        var data = $(this).serializeArray();
        $.ajax({
            type: "POST",
            url: "login/loginProcess.php",
            data: data,
            dataType: "JSON",
            beforeSend: function () {
                $("#registerSpinner").show();
            },
            success: function (response) {
                console.log(response);
                $("#registerSpinner").hide();
                if (response.status) {
                    window.location.href = 'dashboard.php';
                } else {
                    $("#errorAlert").html(response.msg);
                    $("#errorAlert").show();
                }
            },
            error: function (response) {
                $("#errorAlert").html("Error");
                $("#errorAlert").show();
                console.log(response.responseText);
                $("#registerSpinner").hide();
            }
        });
    });
});