<?php
session_start();
try {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'conn2.php';
        $phone = $_POST['phone'];
        $newpass = $_POST['npassword'];
        $rtnewpass = $_POST['Rtnpassword'];


        $sql = "SELECT * from userinfo where contact_number = '$phone'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $cp = $row['contact_number'];
                if (strcmp($phone, $cp) == 0) {
                    if (strcmp($newpass, $rtnewpass) == 0) {
                        $sql2 = "update userinfo set password = '$newpass' where contact_number = '$phone' ";
                        $conn->query($sql2);
                        echo "<script type='text/javascript'>alert('password updated successfully');</script>";
                        echo "<script>window.location.href = 'landingPage.php';</script>";
                        exit();
                    } else {
                        echo "<script type='text/javascript'>alert('new password and retype password doesn\\'t macth!');</script>";
                        echo "<script>window.location.href = 'landingPage.php';</script>";
                        exit();
                    }
                } else {
                    echo "<script type='text/javascript'>alert('Wrong Phone number!');</script>";
                    echo "<script>window.location.href = 'landingPage.php';</script>";
                    exit();
                }
            }
        } else {
            echo "<script type='text/javascript'>alert('Wrong Phone number!');</script>";
            echo "<script>window.location.href = 'landingPage.php';</script>";
            exit();
        }
    } else {
        echo "Invalid request.";
    }
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
