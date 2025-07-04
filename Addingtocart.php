<?php
session_start();
try {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'conn2.php';
        $path = $_POST["path"];
        $prname = $_POST["name"];
        $price = $_POST["price"];
        $size = $_POST["size"];
        $stock = $_POST["stock"];
        $quantity = $_POST["quantity"];
        $pid = $_POST['prd_id'];
        $email =  $_SESSION['user_email'];


        $sql = "SELECT * FROM userinfo WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sql2 = "SELECT * FROM cartitems WHERE product_id = '$pid'";
                $result2 = $conn->query($sql2);

                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        echo "<script type='text/javascript'>alert('This product is Already in your cart!');</script>";
                        echo "<script>window.location.href = 'userDashboard.php';</script>";
                        exit();
                    }
                } else {
                    $id = $row['id'];
                    $sql2 = "Insert into cartitems(userinfo_id,product_id,name,price,stock,quantity,size,p_imagPath) Values('$id','$pid','$prname','$price','$stock','$quantity','$size', '$path')";
                    $conn->query($sql2);
                    echo "<script type='text/javascript'>alert('Product added to cart successfully');</script>";
                    echo "<script>window.location.href = 'userDashboard.php';</script>";
                    exit();
                }
            }
        }
    } else {
        echo "Invalid request.";
    }
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
