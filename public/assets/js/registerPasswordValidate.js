// assets/js/passwordValidation.js

document.addEventListener("DOMContentLoaded", () => {
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("repeat-password");
    const message = document.querySelector(".password-message");
    const registerBtn = document.getElementById("registerBtn");

    function validatePassword() {
        if (password.value.length < 8) {
            message.textContent = "Password must be at least 8 characters long";
            return false;
        } else if (password.value !== confirmPassword.value) {
            message.textContent = "Passwords do not match";
            return false;
        } else {
            message.textContent = "";
            return true;
        }
    }

    // Add click event listener on register button
    registerBtn.addEventListener("click", (e) => {
        if (!validatePassword()) {
            // Show message and prevent form submission if validation fails
            e.preventDefault();
        }
    });
});
