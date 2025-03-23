$(document).ready(function() {
    const loginUrl = "index.php?controller=login&action=authenticate";
    const adminPageUrl = "index.php?controller=admin&action=index";

    $("#loginForm").submit(function(event) {
        event.preventDefault();

        let formData = {
            username: $("#username").val(),
            password: $("#password").val()
        };

        $.post(loginUrl, formData, function(response) {
            if (response.success) {
                loadAdminPanel();
            } else {
                $("error-message").text(response.message);
            }
        }, "json");
    });

    function loadAdminPanel() {
        $.get(adminPageUrl, function(response) {
            $("body").html(response);
        });
    }
});
