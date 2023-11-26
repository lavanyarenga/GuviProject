$(document).ready(function() {

    var userId = localStorage.getItem("userId");

    if (userId) {

        $.ajax({
            type: "POST",
            url: "../php/profile.php",
            data: { userId: userId },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $("#name").text(response.name);
                    $("#email").text(response.email);
                } else {
                    alert("Profile retrieval failed: " + response.message);
                }
            },
            error: function() {
                alert("Error: Unable to communicate with the server");
            }
        });
    } else {

        window.location.href = "../html/login.html";
    }
});
