$(document).ready(function() {
    $("#loginBtn").click(function() {
        var email = $("#email").val();
        var password = $("#password").val();

        $.ajax({
            type: "POST",
            url: "../php/login.php",
            data: { email: email, password: password },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // Store user ID in local storage
                    localStorage.setItem("userId", response.userId);

                    // Redirect to profile page
                    window.location.href = "../html/profile.html";
                } else {
                    alert("Login failed: " + response.message);
                }
            },
            error: function() {
                alert("Error: Unable to communicate with the server");
            }
        });
    });
});
