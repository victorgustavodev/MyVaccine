function togglePassword(inputId, iconId) {
    var input = document.getElementById(inputId);
    var eyeIcon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    } else {
        input.type = "password";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    }
}
