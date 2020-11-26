$(".togglePassword").click(function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    if ($(this).siblings('input').attr("type") == "password") {
        $(this).siblings('input').attr("type", "text");
    } else {
        $(this).siblings('input').attr("type", "password");
    }
});