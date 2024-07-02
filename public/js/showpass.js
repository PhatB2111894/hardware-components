$(document).ready(function() {
    $("#showPass").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#pwd");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
        input.focus();
    });

    $("#showNewPass").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#pwd2");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
        input.focus();
    })
})