<?php
// session_start();
require "../../includes/login_validator.php";
require "../../config.php";
//Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../../index.php");
    exit();
}

$user_id = $_SESSION['username'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/client-dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
    <?php
    require '../../includes/sidebar.php';
    ?>
    <div class="main-content">
        <div class="dashboard-header">
            <h1><i style="color: #f7aa46;" class="fas fa-tachometer-alt"></i> Dashboard Overview</h1>
        </div>

        <div class="quick-stats">
            <?php
            // Get total products
            $products_query = "SELECT COUNT(*) as total FROM inventory_products WHERE created_by = '$user_id'";
            $products_result = mysqli_query($conn, $products_query);
            $total_products = mysqli_fetch_assoc($products_result)['total'];

            // Get total value of inventory
            $value_query = "SELECT SUM(quantity * price) as total FROM inventory_products WHERE created_by = '$user_id'";
            $value_result = mysqli_query($conn, $value_query);
            $total_value = mysqli_fetch_assoc($value_result)['total'];

            // Get low stock items
            $low_stock_query = "SELECT COUNT(*) as total FROM inventory_products WHERE  quantity < 10 AND created_by = '$user_id'";
            $low_stock_result = mysqli_query($conn, $low_stock_query);
            $low_stock = mysqli_fetch_assoc($low_stock_result)['total'];

            // Get recent activities
            $recent_query = "SELECT COUNT(*) as total FROM client_requests WHERE created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR) AND created_by = '$user_id'";
            $recent_result = mysqli_query($conn, $recent_query);
            $recent_activities = mysqli_fetch_assoc($recent_result)['total'];
            ?>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-details">
                    <h3>Total Products</h3>
                    <p><?php echo $total_products; ?></p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-rupee-sign"></i>
                </div>
                <div class="stat-details">
                    <h3>Inventory Value</h3>
                    <p>Rs. <?php if($total_value ){
                        echo number_format($total_value, 2);
                    }else{
                        echo "0.00";
                        }?></p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon warning">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-details">
                    <h3>Low Stock Items</h3>
                    <p><?php echo $low_stock; ?></p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-details">
                    <h3>Recent Activities</h3>
                    <p><?php echo $recent_activities; ?></p>
                </div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="grid-item recent-products">
                <h2><i class="fas fa-boxes"></i> Recent Products</h2>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $recent_products = "SELECT * FROM inventory_products WHERE created_by = '$user_id' ORDER BY created_at DESC LIMIT 5";
                            $result = mysqli_query($conn, $recent_products);
                            if(mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['p_name'] . "</td>";
                                    echo "<td>" . $row['category'] . "</td>";
                                    echo "<td>" . $row['quantity'] . "</td>";
                                    echo "<td>Rs. " . number_format($row['price'], 2) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' style='text-align: center; padding: 20px;'>No recent products found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="grid-item low-stock">
                <h2><i class="fas fa-exclamation-circle"></i> Low Stock Alert</h2>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Stock Left</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $low_stock_items = "SELECT * FROM inventory_products WHERE created_by = '$user_id' AND quantity < 10 ORDER BY quantity ASC LIMIT 5";
                            $result = mysqli_query($conn, $low_stock_items);
                            if(mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $status_class = $row['quantity'] <= 5 ? 'critical' : 'warning';
                                $status_text = $row['quantity'] <= 5 ? 'Critical' : 'Warning';
                                
                                echo "<tr>";
                                echo "<td>" . $row['p_name'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td><span class='status-badge " . $status_class . "'>" . $status_text . "</span></td>";
                                echo "</tr>";
                            }
                        }else{
                            echo "<tr><td colspan='4' style='text-align: center; padding: 20px;'>No Low stock Product Found</td></tr>";

                        }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="grid-item recent-activities">
                <h2><i class="fas fa-history"></i> Recent Activities</h2>
                <div class="activity-list">
                    <?php
                    $activities = "SELECT * FROM client_requests WHERE requested_to ='$user_id' ORDER BY created_at DESC LIMIT 5";
                    if(mysqli_num_rows($result) > 0) {
                    $result = mysqli_query($conn, $activities);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='activity-item'>";
                        echo "<div class='activity-icon'><i class='fas fa-circle'></i></div>";
                        echo "<div class='activity-details'>";
                        echo "<p>" . $row['request_type'] . " - " . $row['status'] . "</p>";
                        echo "<small>" . date('M d, Y H:i', strtotime($row['created_at'])) . "</small>";
                        echo "</div>";
                        echo "</div>";
                    }
                }else{
                    echo " <p style='color:black; padding: 10px; text-align:center; '>No Recent Activity </p>";
                }
                    ?>
                </div>
            </div>
        </div>

        <style>
            .main-content {
                padding: 20px;
                margin-left: 250px;
            }

            .dashboard-header {
                margin-bottom: 30px;
            }

            .dashboard-header h1 {
                color: #333;
                font-size: 2em;
            }

            .quick-stats {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
                margin-bottom: 30px;
            }

            .stat-card {
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
                display: flex;
                align-items: center;
            }

            .stat-icon {
                background: #f7aa46;
                color: white;
                width: 50px;
                height: 50px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 15px;
                font-size: 1.5em;
            }

            .stat-icon.warning {
                background: #ff9800;
            }

            .stat-details h3 {
                color: #666;
                font-size: 0.9em;
                margin: 0;
            }

            .stat-details p {
                color: #333;
                font-size: 1.5em;
                font-weight: bold;
                margin: 5px 0 0 0;
            }

            .dashboard-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
                gap: 20px;
            }

            .grid-item {
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            }

            .grid-item h2 {
                color: #333;
                font-size: 1.2em;
                margin-bottom: 20px;
            }

            .grid-item h2 i {
                color: #f7aa46;
                margin-right: 10px;
            }

            .table-responsive {
                overflow-x: auto;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                padding: 12px;
                text-align: left;
                border-bottom: 1px solid #ddd;
                color: #333;
            }

            th {
                background-color: #f7aa46;
                color: white;
            }

            .status-badge {
                padding: 5px 10px;
                border-radius: 20px;
                font-size: 0.8em;
                font-weight: bold;
            }

            .critical {
                background-color: #ff4444;
                color: white;
            }

            .warning {
                background-color: #ffbb33;
                color: white;
            }

            .activity-list {
                max-height: 300px;
                overflow-y: auto;
            }

            .activity-item {
                display: flex;
                align-items: center;
                padding: 10px 0;
                border-bottom: 1px solid #eee;
            }

            .activity-icon {
                margin-right: 15px;
                color: #f7aa46;
            }

            .activity-details p {
                margin: 0;
                color: #333;
            }

            .activity-details small {
                color: #666;
            }
        </style>
    </div>
   


</body>

</html>