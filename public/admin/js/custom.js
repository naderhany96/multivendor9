$(document).ready(function () {
    $("#current_password").keyup(function () {
        var current_password = $("#current_password").val();

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "check-password",
            data: { current_password: current_password },
            success: function (resp) {
                if (resp == "true") {
                    $("#check_password_msg").html(
                        "<font color='green'>Current password is correct!</font>"
                    );
                } else if (resp == "false") {
                    $("#check_password_msg").html(
                        "<font color='red'>Current password is incorrect!</font>"
                    );
                }
            },
            error: function () {
                console.log("Error");
            },
        });
    });

    // image preview
    $(".image").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(".image-preview").attr("src", e.target.result);
            };

            reader.readAsDataURL(this.files[0]);
        }
    });
});
