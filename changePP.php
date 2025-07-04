<?php
session_start();


try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'conn2.php';


        $email = $_POST['email'];
        $filePath = $_POST["path"];
        if (isset($_FILES["ppics"]) && $_FILES["ppics"]["error"] == 0) {

            $fileName = $_FILES["ppics"]["name"];
            $fileTmpName = $_FILES["ppics"]["tmp_name"];
            $fileSize = $_FILES["ppics"]["size"];
            $fileType = $_FILES["ppics"]["type"];


            $uploadDir = "pics/avatars/";
            $filePath = $uploadDir . $fileName;

            // Move the uploaded file to a new location
            if (move_uploaded_file($fileTmpName, $filePath)) {
                $filePath;
            } else {
                echo "Error moving file.";
            }
        }
        $sql2 = "update userinfo set image_path = '$filePath' where email = '$email' ";
        $conn->query($sql2);
        $role =  $_SESSION['role'];
        if ($role == 'admin') {
            echo "<script type='text/javascript'>alert('Profile updated successfully');</script>";
            echo "<script>window.location.href = 'adminDashboard.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Profile updated successfully');</script>";
            echo "<script>window.location.href = 'userDashboard.php';</script>";
        }
    } else {
        echo "Invalid request.";
    }
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
