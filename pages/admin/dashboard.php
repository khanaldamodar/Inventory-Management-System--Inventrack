<?php

require "../../config.php";
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../../assets/css/admin-dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .profile-card {
            background-color: #2a2d38;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .profile-card:hover {
            transform: translateY(-5px);
        }

        .user-table {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
            width: 100%;
            margin: 0 auto;
        }

        .image-placeholder {
            width: 70px;
            height: 70px;
            border-radius: 4px;
            margin: 0 auto;
        }

        .details {
            text-align: center;
        }

        .details h2 {
            margin: 0;
            font-size: 1.5rem;
            color: white;
        }

        .details .designation {
            font-size: 1rem;
            color: #b0b3bd;
            margin: 4px 0;
        }

        .details .contact {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            margin: 4px 0;
            color: #fff;
            gap: 8px;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
        }

        .actions button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            list-style: none;
            padding: 0;
            margin: 0;
            justify-content: center;
        }

        .create-admin {
            text-decoration: none;
            color: white;
            font-size: 1rem;
            background-color: #2a2d38;
            padding: 7px 15px;
            border-radius: 4px;
            transition: 0.3s ease-in;
        }

        .create-admin:hover {
            background-color: #dadada;
            color: black;
        }

        @media (max-width: 768px) {
            .user-table {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }

            .nav-links {
                flex-direction: column;
                align-items: center;
            }
        }

        @media (max-width: 480px) {
            .profile-card {
                width: 100%;
            }

            .user-table {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <nav>
        <ul class="navbar">
            <li>
                <h1>Inven<span style="color: rgb(247, 170, 70)">Track</span></h1>
            </li>
            <ul class="nav-links">
                <li><a class="create-admin" href="admin_list.php">Admin List</a></li>
                <li><a class="create-admin" href="create_admin.php">Create Admin</a></li>
                <li><a class="logout-btn" href="logout.php">Logout</a></li>
            </ul>
        </ul>
    </nav>

    <div class="container">
        <h1 style="color: black; text-align:center;">Application Users List</h1>
        <div class="user-table">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <div class="profile-card">
                        <img src="../../assets/img/profile.png" alt="" class="image-placeholder">
                        <div class="details">
                            <h2>' . $row['first_name'] . ' ' . $row['last_name'] . '</h2>
                            <p class="designation">' . $row['company_name'] . '</p>
                            <p class="contact"><span>📧</span>' . $row['email'] . '</p>
                            <p class="contact"><span>📞</span>+977 ' . $row['phone_number'] . '</p>
                        </div>
                        <form action="action.php" method="post" class="actions">
                            <input type="hidden" name="username" value="' . $row['username'] . '">
                            <input type="hidden" name="firstName" value="' . $row['first_name'] . '">
                            <input type="hidden" name="lastName" value="' . $row['last_name'] . '">
                            <input type="hidden" name="address" value="' . $row['address'] . '">
                            <input type="hidden" name="state" value="' . $row['state'] . '">
                            <input type="hidden" name="postal" value="' . $row['postal_code'] . '">
                            <input type="hidden" name="phone" value="' . $row['phone_number'] . '">
                            <input type="hidden" name="company" value="' . $row['company_name'] . '">
                            <input type="hidden" name="email" value="' . $row['email'] . '">
                            <button name="edit"><i style="color: blue; font-size:20px;" class="fa-solid fa-edit"></i></button>
                            <button name="delete"><i style="color: red; font-size:20px;" class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>