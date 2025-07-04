<?php

session_start();

if (!isset($_SESSION['role'])) {

    header("Location: landingPage.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/png" href="pics/bastalogo.png">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/adminDashboard.css">

    <script>
        function preventBack() {
            window.history.forward()
        };
        setTimeout("preventBack()", 0);
        window.onunload = function() {
            null;
        }
    </script>
</head>

<body>




    <div class="aaa" id="container">
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
                        <li><a href="#">Home</a></li>
                        <li><a href="user.php">Users</a></li>
                        <li><a href="products.php">Products</a></li>
                        <li><a href="dataReports.php">Data reports</a></li>

                    </ul>

                </div>
            </div>

            <div class="main-content" id="mainContent">
                <h1>
                    WELCOME ADMIN!!
                </h1>
                <div class="container">
                    <div class="card users">
                        <h2>Users</h2>
                        <?php

                        include 'conn2.php';

                        $sql2 = "SELECT * FROM userinfo where role = 'user'";
                        $result2 = $conn->query($sql2);

                        if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                $rowcount = mysqli_num_rows($result2);

                                echo <<<HTML
                                        <p>{$rowcount}</p>
                                     HTML;


                                break;
                            }
                        } else {
                            echo <<<HTML
                                    <p>0</p>
                                    HTML;
                        }
                        ?>
                    </div>

                    <div class="card products">
                        <h2>Products</h2>
                        <?php

                        include 'conn2.php';

                        $sql2 = "SELECT * FROM productitem";
                        $result2 = $conn->query($sql2);

                        if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                $rowcount = mysqli_num_rows($result2);
                                echo <<<HTML
                            
                                
                                <p>{$rowcount}</p>
                            
                                
                            HTML;
                                break;
                            }
                        } else {
                            echo <<<HTML
                                    <p>0</p>
                                    HTML;
                        }
                        ?>
                    </div>

                    <div class="card sales">
                        <h2>Sales today</h2>
                        <?php

                        include 'conn2.php';

                        $sql2 = "SELECT DATE(saledate) as purchase_day, SUM(totalsale) as G_total FROM totalsales GROUP BY DATE(saledate)
                    ORDER BY DATE(saledate) ASC";
                        $result2 = $conn->query($sql2);
                        $dateToday = date('Y-m-d');
                        if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                $rowcount = mysqli_num_rows($result2);
                                if ($dateToday == $row['purchase_day']) {
                                    echo <<<HTML
                               
                                    
                                    <p>{$row['purchase_day']}</p>
                                    <p>{$row['G_total']}</p>
                              
            
                            HTML;
                                }
                            }
                        } else {
                            echo <<<HTML
                                    <p>0</p>
                                    HTML;
                        }
                        ?>
                    </div>



                </div>


            </div>
        </div>


    </div>





    <script src="javscript/adminDashboard.js"></script>
</body>

</html>