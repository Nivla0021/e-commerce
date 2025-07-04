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
    <title>Edit review</title>
    <link rel="icon" type="image/png" href="pics/bastalogo.png">
    <link rel="stylesheet" href="css/edit_review_prod.css">
</head>

<body>
    <?php
    include 'header.php';
    ?>


    <div class="modal-content3">

        <?php

        try {

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST['id'];
                $revId = $_POST['Revid'];
                include 'conn2.php';
                $sql = "SELECT * FROM productitem WHERE id = '$id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $pic = $row['image_path'];
                        $name = $row['name'];
                        $price = $row['price'];
                        $userID = $_SESSION['user_id'];


                        echo <<<HTML
                                   
                                    
                                <h2>Edit Review</h2>
                                <form action="submitEditReview.php" method="POST">
                                <img id="reviewProductImage" src='{$pic}' alt="Product Image">
                                <div class="product-name">Product name: {$name}</div>
                                <div class="product-price">Price: ₱ {$price}</div>
                                <div class="form-group">
                                    <label for="rating">Rating (1-5):</label>
                                    <input type="number" id="myNumberInput" name="rating" min="1" max="5" required>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Comment:</label>
                                    <textarea id="comment" name="comment" rows="4" required></textarea>
                                </div>
                                <input type="hidden" name="prod_id" value="{$id}">
                                <input type="hidden" name="user_id" value="{$userID}">
                                <input type="hidden" name="revId" value="{$revId}">
                                <input type="submit" value="Sumbit" id="submitReviewBtn">
                                </form>
                                
                           
                       
                                    
                        HTML;
                        break;
                    }
                }
            } else {
                echo "Invalid request.";
            }
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

        ?>
    </div>

    <script src="javscript/edit_review_prod.js"></script>
</body>

</html>