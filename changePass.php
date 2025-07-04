<?php
session_start();
if (!isset($_SESSION['role'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: landingPage.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
    <link rel="icon" type="image/png" href="pics/bastalogo.png">
    <link rel="stylesheet" href="css/changePass.css">
    <style>

    </style>
</head>

<body>
    <?php
    $role = $_SESSION['role'];
    if ($role == 'user') {
        include 'header.php';
    } else {
        include 'headerAdmin.php';
    }



    ?>
    <div class="details">
        <form action="submitCpass.php" method="post">
            <div class="pass-container">
                <input type="password" name="currpass" id="password1" placeholder="Enter current password" required class="pass">
                <img src="pics/eye.png" alt="Show/Hide Password" class="toggle-icon">
            </div>
            <div class="pass-container">
                <input type="password" name="newpass" id="password2" placeholder="Enter new password" required class="inp">
                <img src="pics/eye.png" alt="Show/Hide Password" class="toggle-icon">
            </div>
            <div class="pass-container">
                <input type="password" name="con_newpass" id="password3" placeholder="Confirm new password" required class="inp">
                <img src="pics/eye.png" alt="Show/Hide Password" class="toggle-icon">
            </div>
            <br>
            <input type="submit" value="Save" class="sbmt">
        </form>

    </div>

    <script src="javscript/show_hidePass.js"></script>

</body>

</html>