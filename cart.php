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
    <title>Shopping Cart</title>
    <link rel="icon" type="image/png" href="pics/bastalogo.png">
    <link rel="stylesheet" href="css/cart.css">
    <style>
        .user_det {
            border: 1px solid black;
            width: 400px;
            padding: 10px;
            border-radius: 20px;
            background-color: lightskyblue;
        }

        .user_det h3 {
            font-weight: 100;
        }

        .user_det h3 span {
            font-weight: 600;
        }

        .d-1 {
            --c: #1095c1;
            /* the color */
            --b: .1em;
            /* border length*/
            --d: 20px;
            /* the cube depth */
            --h: 1.2em;
            /* the height */

            --_s: calc(var(--d) + var(--b));

            line-height: var(--h);
            color: #0000;
            padding: 10px;
            text-shadow:
                0 calc(-1*var(--_t, 0em)) var(--c),
                0 calc(var(--h) - var(--_t, 0em)) #fff;
            border: solid #0000;
            overflow: hidden;
            border-width: var(--b) var(--b) var(--_s) var(--_s);
            background:
                linear-gradient(var(--c) 0 0) 100% 100% /101% var(--_p, 0%) no-repeat,
                conic-gradient(at left var(--d) bottom var(--d),
                    #0000 90deg, rgb(255 255 255 /0.3) 0 225deg, rgb(255 255 255 /0.6) 0) border-box,
                conic-gradient(at left var(--_s) bottom var(--_s),
                    #0000 90deg, var(--c) 0) 0 100%/calc(100% - var(--b)) calc(100% - var(--b)) border-box;
            transform: translate(calc(var(--d)/-1), var(--d));
            clip-path:
                polygon(var(--d) 0%,
                    var(--d) 0%,
                    100% 0%,
                    100% calc(100% - var(--d)),
                    100% calc(100% - var(--d)),
                    var(--d) calc(100% - var(--d)));
            transition: 0.5s;
        }

        .d-1:hover {
            transform: translate(0, 0);
            clip-path:
                polygon(0% var(--d),
                    var(--d) 0%,
                    100% 0%,
                    100% calc(100% - var(--d)),
                    calc(100% - var(--d)) 100%,
                    0% 100%);
            --_t: var(--h);
            --_p: 105%;
        }
    </style>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <div class="p_history">
        <a href="purchaseHistory.php">
            <h3 class="d-1">Purchase History</h3>
        </a>
    </div>
    <div class="cart-container">





        <?php
        include 'conn2.php';
        $email = $_SESSION['user_email'];
        $sql2 = "SELECT id FROM userinfo where email = '$email'";
        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {

            while ($row = $result2->fetch_assoc()) {
                $id = $row['id'];
                $sql = "SELECT * FROM cartitems INNER JOIN userinfo ON cartitems.userinfo_id = userinfo.id where userinfo_id = '$id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $rowcount = mysqli_num_rows($result);
                    while ($row = $result->fetch_assoc()) {

                        $imPath = "";
                        $qty = $row['quantity'];
                        $STOCK = 0;
                        $name = "";
                        $size = "";
                        $price = 0.00;
                        $select = "SELECT * from productitem where id = '{$row['Product_id']}'";
                        $result2 = $conn->query($select);
                        if ($result2->num_rows > 0) {
                            $rowcount1 = mysqli_num_rows($result2);
                            while ($row1 = $result2->fetch_assoc()) {
                                $STOCK = $row1['stock'];
                                $imPath = $row1['image_path'];
                                $name = $row1['name'];
                                $size = $row1['size'];
                                $price = $row1['price'];
                            }
                        }
                        echo <<<HTML
                <div class="cart-item">
                <input type="checkbox" class="cart-checkbox">
                <img src='{$imPath}' alt="Product 1" class="cart_img">
                <div class="cart-item-info">
                <h3>{$name}</h3>
                <h4 id="stock">Stock: {$STOCK}</h4>
                <h1 style="display:none;">{$row['cart_id']}</h1>
                <h1 style="display:none;" class="prid">{$row['Product_id']}</h1>
                <h5 id="stock">Size: {$size}</h5>
                <div class="aas"><h5>&#8369;</h5> <span>{$price}</span></div>
                <div class="quantity">
                    QTY:
                    <input type="number" value='{$qty}' min="1" id="quantity" max='{$row["stock"]}'>
                </div>
                <form action="remvCart.php" method="POST">
                    <input type="hidden" name="id" value="{$row['cart_id']}">
                    <input type="submit" value="Remove" class="remove-item" name="del" onclick="return confirmDelete()">
                </form>
                

                
                </div>
            </div>
        HTML;
                    }
                }
            }
        }

        ?>


        <form action="removeCartAll.php" method="POST">
            <?php
            include 'conn2.php';
            $email = $_SESSION['user_email'];
            $sql2 = "SELECT id FROM userinfo where email = '$email'";
            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0) {

                while ($row = $result2->fetch_assoc()) {
                    echo <<<HTML
                            <input type="submit" value="Remove All Items"  name="del" onclick="return confirmDeleteAll()" id="remove-all">
                            <input type="hidden" name="u_id" value="{$row['id']}">
                    HTML;
                }
            }
            ?>

        </form>
        <button id="checkout" class="disabled">Checkout</button>
        <div id="total-price">Total Price: &#8369;0.00</div>
    </div>

    <div id="order-summary-modal">
        <div class="modal-content1">
            <span class="modal-close">&times;</span>
            <h2>Order Summary</h2><br> <br>
            <?php
            $id = $_SESSION['user_id'];
            $sql = "SELECT * from userinfo where id = '$id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo <<< HTML
                        <div class="user_det">
                        <h3>Name: <span>{$row['first_name']}  {$row['last_name']}</span></h3>
                        <h3>Address: <span>{$row['address']}</span></h3>
                        <h3>Mobile#: <span>{$row['contact_number']}</span></h3>
                        </div>
                        
                        HTML;
                }
            }
            ?>
            <br>
            <br>
            <ul id="ordered-items"></ul>
            <label for="input-amount">Pay via Gcash:</label>
            <input type="number" id="input-amount" placeholder="Enter amount">
            <div id="total-amount"></div>
            <button id="confirm-payment">Confirm Payment</button>
        </div>
    </div>


    <script src="javscript/cart.js"></script>
</body>

</html>