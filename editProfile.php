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
    <title>Edit Profile</title>
    <link rel="icon" type="image/png" href="pics/bastalogo.png">
    <link rel="stylesheet" href="css/editProfile.css">
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
        <form action="submitEditProfile.php" method="POST">
            <?php
            $id = $_SESSION['user_id'];
            include 'conn2.php';
            $sql = "SELECT * FROM userinfo WHERE id = '$id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    echo ' <input type="text" placeholder="First name" name="fname" class="da" value="' . $row['first_name'] . '"><br>
                        <input type="text" placeholder="Last name" name="lname" class="da" value="' . $row['last_name'] . '"><br>
                        <input type="number" placeholder="Phone number" name="number" class="da" value="' . $row['contact_number'] . '"><br>
                        <input type="email" placeholder="Email Address" name="eAdd" class="da" value="' . $row['email'] . '"><br>
                        <input type="text" placeholder="Address" name="addr" class="da" value="' . $row['address'] . '"><br>
                        <input type="submit" value="Save" class="sbmt">';
                }
            }
            ?>

        </form>



    </div>



</body>

</html>