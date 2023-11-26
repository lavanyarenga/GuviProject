$(document).ready(function() {
    $("#registerBtn").click(function() {
        var name = $("#name").val();
        var email = $("#email").val();
        var password = $("#password").val();

        $.ajax({
            type: "POST",
            url: "../php/register.php",
            data: { name: name, email: email, password: password },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    alert("Registration successful. Please log in.");
                    window.location.href = "../html/login.html";
                } else {
                    alert("Registration failed: " + response.message);
                }
            },
            error: function() {
                alert("Error: Unable to communicate with the server");
            }
        });
    });
});
