<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/userPage.css">
    <style>
        .nav_links,
        .serchbar,
        .search_icon,
        #user_cart,
        #item_qty {
            display: none;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="sec1">
            <a href="adminDashboard.php"><img src="pics/bastalogo.png" alt="logo" class="nav_logo"></a>
        </div>

        <div class="sec2">
            <a href="userDashboard.php" class="pr">
                <ul class="nav_links">
                    <li>Products</li>
                </ul>
            </a>

        </div>

        <div class="sec3">
            <form action="header.php" method="get" id="sad">
                <input type="text" name="search" id="" class="serchbar" placeholder="Search for T-shirt">
                <img src="pics/search.png" alt="sicon" class="search_icon" onClick="submit('sad')">
            </form>
        </div>

        <div class="nav_img">
            <?php
            $id = $_SESSION['user_id'];
            include 'conn2.php';
            $sql = "SELECT * FROM UserInfo WHERE id = '$id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imPath = $row['image_path'];
                    echo <<<HTML
                                    <img src='{$imPath}' alt="profile" id="user_profile_pic" onclick="openModal('userProfile')">
                            HTML;
                }
            }
            ?>
            <a href="cart.php"><img src="pics/shopping-cart.png" alt="cart" id="user_cart"></a>
            <?php
            include 'conn2.php';
            $Userid = $_SESSION['user_id'];
            $sql2 = "SELECT id FROM userinfo where id = '$Userid'";
            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0) {
                while ($row = $result2->fetch_assoc()) {
                    $id = $row['id'];
                    $sql = "SELECT * FROM cartitems INNER JOIN userinfo ON cartitems.userinfo_id = userinfo.id where userinfo_id = '$id'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $rowcount = mysqli_num_rows($result);
                        while ($row = $result->fetch_assoc()) {

                            echo <<<HTML
               
                <p id="item_qty">{$rowcount}</p>
        HTML;
                        }
                    }
                }
            }


            ?>

            <div class="lg">
                <a href="logout.php" onclick="return confirmLogout()"> <img src="pics/turn-off.png" alt="logout" id="log_out"></a>
            </div>
        </div>



        <div id="userProfile" class="modal">
            <div class="modal-content">


                <div class="container">
                    <span class="close" onclick="closeModal('userProfile')">&times;</span>
                    <div class="pic_container">
                        <?php
                        $id = $_SESSION['user_id'];
                        include 'conn2.php';
                        $sql = "SELECT * FROM UserInfo WHERE id = '$id'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $imPath = $row['image_path'];
                                echo <<<HTML
                                    <img src='{$imPath}' alt="profile" id="prof_pic" onclick="openModal('userProfile_upload')">
                                        <div id="user_fullname">   {$row['first_name']}  {$row['last_name']}</div>
                                        <div class="up" onclick="openModal('userProfile_upload')">Upload a Photo</div>
                                    </div>
                                    <div class="info">
                                        <div class="info_con">
                                            
                                            <div>Phone: {$row['contact_number']}</div>
                                        </div>
                                        <div class="info_con">
                                            
                                            <div>Email: {$row['email']}</div>
                                        </div>
                                        <div class="info_con">
                                            
                                            <div>Address: {$row['address']}</div>
                                        </div>
                
                                        <div class="info_but">
                                            <form action="editProfile.php" method="get">
                                                <input type="submit" value="Edit" id="edit">
                                            </form>
                                            <form action="changePass.php" method="get">
                                                <input type="submit" value="Change password" id="change_pass">
                                            </form>
                
                                        </div>
                            HTML;
                            }
                        }
                        ?>
                    </div>


                </div>



            </div>
        </div>


        <div id="userProfile_upload" class="modal">
            <div class="modal-content">


                <div class="modal-content-uploadpp">
                    <span class="close" onclick="closeModal('userProfile_upload')">&times;</span>
                    <?php
                    $id = $_SESSION['user_id'];
                    include 'conn2.php';
                    $sql = "SELECT * FROM UserInfo WHERE id = '$id'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $imPath = $row['image_path'];
                            $email = $row['email'];

                            echo <<<HTML
                                        <form action="changePP.php" method="post" enctype="multipart/form-data">
                                            <div id="profile-container">
                                                <img id="profile-pic" src='{$imPath}' alt="Profile Picture">
                                                <input type="hidden" name="path" value='{$imPath}'>
                                                <input type="hidden" name="email" value='{$email}'>
                                                <input type="file" id="upload-input" accept="image/*" style="display: none;" name="ppics">
                                                <label for="upload-input" id="upload-label">Change Picture</label>
                                            </div>
                                            <input type="submit" value="Save" id="save_pp">
                                        </form>
                                        
                                        HTML;
                        }
                    }
                    ?>


                </div>



            </div>
        </div>




    </div>

    <script src="javscript/header.js"></script>
    <script src="javscript/modaljs.js"></script>
    <script src="javscript/uploadphoto.js"></script>
</body>

</html>