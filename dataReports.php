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
    <title>Data Reports</title>
    <link rel="icon" type="image/png" href="pics/bastalogo.png">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/dataReports.css">
</head>

<body>


    <div class="cont" id="container">
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
                        <li><a href="#" onclick="changeContent('dReports')">Data Reports</a></li>
                    </ul>

                </div>
            </div>


            <div class="main-content" id="mainContent">
                <?php


                include 'conn2.php';


                // Initialize the default selection
                $selected_option = isset($_GET['option']) ? $_GET['option'] : 'day';

                // Handle selection from the dropdown
                if (isset($_GET['option'])) {
                    switch ($_GET['option']) {
                        case 'day':
                            $sql = "SELECT DATE(saledate) AS purchase_day, SUM(totalsale) AS total_sales
                    FROM totalsales
                    GROUP BY DATE(saledate)
                    ORDER BY DATE(saledate) ASC";
                            break;
                        case 'week':
                            $sql = "SELECT CONCAT(YEAR(saledate), '-', WEEK(saledate)) AS purchase_week, SUM(totalsale) AS total_sales
                    FROM totalsales
                    GROUP BY CONCAT(YEAR(saledate), '-', WEEK(saledate))
                    ORDER BY CONCAT(YEAR(saledate), '-', WEEK(saledate)) ASC";
                            break;
                        case 'month':
                            $sql = "SELECT CONCAT(YEAR(saledate), '-', MONTH(saledate)) AS purchase_month, SUM(totalsale) AS total_sales
                    FROM totalsales
                    GROUP BY CONCAT(YEAR(saledate), '-', MONTH(saledate))
                    ORDER BY CONCAT(YEAR(saledate), '-', MONTH(saledate)) ASC";
                            break;
                        default:
                            $sql = "SELECT DATE(saledate) AS purchase_day, SUM(totalsale) AS total_sales
                    FROM totalsales
                    GROUP BY DATE(saledate)
                    ORDER BY DATE(saledate) ASC";
                    }
                } else {
                    $sql = "SELECT DATE(saledate) AS purchase_day, SUM(totalsale) AS total_sales
            FROM totalsales
            GROUP BY DATE(saledate)
            ORDER BY DATE(saledate) ASC";
                }

                $result = $conn->query($sql);

                $conn->close();
                ?>
                <h1>Total Sales Report</h1>
                <form method="GET">
                    <div class="dropdown">
                        <label for="option" class="label">Select Sales Type:</label>
                        <select name="option" id="option" class="select">
                            <option value="day" <?php echo ($selected_option == 'day') ? 'selected' : ''; ?>>Sales by Day</option>
                            <option value="week" <?php echo ($selected_option == 'week') ? 'selected' : ''; ?>>Sales by Week</option>
                            <option value="month" <?php echo ($selected_option == 'month') ? 'selected' : ''; ?>>Sales by Month</option>
                        </select>

                    </div>
                    <input type="submit" value="Show" class="subt-btn">

                </form>

                <?php if ($result->num_rows > 0) : ?>

                    <table>
                        <tr>
                            <?php if ($selected_option == 'day') : ?>
                                <th>Day</th>
                            <?php elseif ($selected_option == 'week') : ?>
                                <th>Week</th>
                            <?php elseif ($selected_option == 'month') : ?>
                                <th>Month</th>
                            <?php endif; ?>
                            <th>Total Sales</th>
                        </tr>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $row['purchase_day'] ?? ($row['purchase_week'] ?? $row['purchase_month']); ?></td>
                                <td><?php echo $row['total_sales']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                <?php else : ?>
                    <p>No sales data available.</p>
                <?php endif; ?>


            </div>
        </div>

    </div>

    <script src="javscript/toggleSidebar.js"></script>
</body>

</html>