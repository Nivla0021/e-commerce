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
    <title>Edit product</title>
    <link rel="icon" type="image/png" href="pics/bastalogo.png">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/editproduct.css">
</head>

<body>
    <div class="cont" id="container1">
        <?php
        include 'headerAdmin.php';
        ?>

        <div class="ma">

            <div>
                <div class="tgButton">
                    <div class="close-btn" onclick="toggleSidebar()"><img src="pics/left-arrow.png" alt="" class="L-arrow"></div>
                </div>
                <div class="sidebar">

                    <ul>
                        <li><a href="adminDashboard.php" onclick="changeContent('home')">Home</a></li>
                        <li><a href="user.php" onclick="changeContent('users')">Users</a></li>
                        <li><a href="products.php" onclick="changeContent('products')">Products</a></li>
                        <li><a href="dataReports.php" onclick="changeContent('dReports')">Data reports</a></li>
                    </ul>

                </div>
            </div>

            <div class="main-content" id="mainContent">
                <div class="edit_con">
                    <div>
                        <div class="container1">
                            <h2>Edit Product</h2>
                            <?php
                            $id = $_POST['user_id'];
                            include 'conn2.php';
                            $sql = "SELECT * FROM productitem WHERE id = '$id'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $path = $row['image_path'];

                                    echo '<form action="submitEditprod.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <img src="' . $row['image_path'] . '" alt="image" class="edit_img" id="profile_pic"  >
                                    <input type="hidden" name="edit_id" value="' . $id . '">
                                    <input type="hidden" name="edit_file" value="' . $row['image_path'] . '">
                                    
                                </div>


                                <div class="form-group">
                                    <input type="file" id="uploads-input" accept="image/*" style="display: none;" name="product_new">
                                    <label for="uploads-input"  class="upPics">Change Picture</label>
                                
                                </div>
                                
                               
                        
                                <div class="form-group">
                                    <label for="product_name">Product Name:</label>
                                    <input type="text" id="product_name" name="product_name" value="' . $row['name'] . '" required autocomplete="off">
                                </div>


                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input type="number" id="price" name="price" min="0" step="0.01" value="' . $row['price'] . '" required>
                                </div>


                                <div class="form-group">
                                    <label for="size">Size:</label>
                                    <select id="size" name="size" required>
                                        <option value="small" ' . ($row['size'] == 'small' ? 'selected' : '') . '>Small</option>
                                        <option value="medium" ' . ($row['size'] == 'medium' ? 'selected' : '') . '>Medium</option>
                                        <option value="large" ' . ($row['size'] == 'large' ? 'selected' : '') . '>Large</option>
                                        <option value="xl" ' . ($row['size'] == 'xl' ? 'selected' : '') . '>XL</option>
                                    </select>
                                </div>


                                <div class="form-group" id="categ">
                                    <label for="keyword">Category:</label>
                                    <input id="keyword" name="keyword" type="text" value="' . $row['keyword'] . '" required autocomplete="off">
                                    <div id="suggestions" class="suggestions"></div>
                                </div>


                                <div class="form-group">
                                    <label for="stock">Stock:</label>
                                    <input type="number" id="stock" name="stock" min="0" required value="' . $row['stock'] . '">
                                </div>
                                <input type="submit" value="Save"> 
                            </form>';
                                }
                            }
                            ?>







                        </div>
                    </div>


                </div>
            </div>
        </div>


        <script src="javscript/editproduct.js"></script>


</body>

</html>