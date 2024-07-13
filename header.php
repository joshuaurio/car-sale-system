<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jaki General Supply</title>
    <link rel="stylesheet" href="header_styles.css"> <!-- Include your header CSS file for consistent styling -->
    <style>
        /* Additional styles specific to header.php */
        header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }

        .nav-links a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .profile-links {
            display: flex;
            gap: 20px;
        }

        .profile-links a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }

        .profile-links a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            Jaki General Supply
        </div>
        <nav>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="add_car.php">Add Car</a> <!-- Example of navigation link -->
            </div>
        </nav>
        <div class="profile-links">
            <a href="#">Notification</a> <!-- Placeholder for Notification link -->
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>
</body>
</html>
