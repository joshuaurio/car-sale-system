<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        /* Basic reset and styling for the header */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            flex: 1;
            text-align: left;
        }

        .header-center {
            flex: 2;
            text-align: center;
        }

        .header-right {
            flex: 1;
            text-align: right;
        }

        .header-link {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        .header-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <a href="index.php" class="header-link">Jaki General Supply</a>
        </div>
        <div class="header-center">
            <a href="add_car.php" class="header-link">Add Car</a>
            <a href="modify_car.php" class="header-link">All Cars</a>
            <a href="notification.php" class="header-link">Notification</a>
        </div>
        <div class="header-right">
            <a href="profile.php" class="header-link">Profile</a>
            <a href="logout.php" class="header-link">Log Out</a>
        </div>
    </div>
</body>
</html>
