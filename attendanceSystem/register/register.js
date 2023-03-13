$(document).ready(function () {
    $("#registerSpinner").hide();
    $("#errorAlert").hide();
    $("#successAlert").hide();

    $("#registrationForm").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "registerProcess.php",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "JSON",
            beforeSend: function () {
                $("#registerSpinner").show();
            },
            success: function (response) {
                console.log(response)
                $("#registerSpinner").hide();
                if (response.status == 'error') {
                    $("#errorAlert").html(response.msg);
                    $("#errorAlert").show();
                } else {
                    $("#errorAlert").hide();
                    $("#successAlert").show();
                    $('#registrationForm').trigger("reset");
                }
            },
            error: function (response) {
                $("#errorAlert").html("We encounter a problem when creating your account.");
                $("#errorAlert").show();
                console.log(response.responseText);
                $("#registerSpinner").hide();
            }
        });
    });


});
