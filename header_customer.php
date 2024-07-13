<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jaki General Supply</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file for styling -->
    <style>
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
            <a href="wishlist.php" class="header-link">Wishlist</a>
            <a href="orders.php" class="header-link">Orders</a>
        </div>
        <div class="header-right">
            <a href="profile.php" class="header-link">Profile</a>
            <a href="logout.php" class="header-link">Log Out</a>
        </div>
    </div>
</body>
</html>
