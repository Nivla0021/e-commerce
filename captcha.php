<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $captcha = $_POST['captcha'];
    $generatedCaptcha = $_SESSION['captcha'];

    if ($captcha == $generatedCaptcha) {
        // CAPTCHA validation successful, you can proceed with registration
        // For demonstration purposes, let's just echo the data
        echo "Username: $username <br>";
        echo "Email: $email <br>";
        echo "Password: $password <br>";
        echo "CAPTCHA: $captcha <br>";
    } else {
    }
} else {
    echo "Invalid request.";
}
