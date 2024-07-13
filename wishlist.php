<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle remove action
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove_id'])) {
        $remove_id = $_POST['remove_id'];

        // Delete car from wishlist
        $delete_sql = "DELETE FROM wishlist WHERE id = '$remove_id' AND user_id = '$user_id'";
        if ($conn->query($delete_sql) === TRUE) {
            $_SESSION['success'] = "Car removed from wishlist successfully.";
        } else {
            $_SESSION['error'] = "Error removing car from wishlist: " . $conn->error;
        }
    }

    if (isset($_POST['process_id'])) {
        $process_id = $_POST['process_id'];

        // Move car from wishlist to orders
        $select_sql = "SELECT car_id FROM wishlist WHERE id = '$process_id' AND user_id = '$user_id'";
        $result = $conn->query($select_sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $car_id = $row['car_id'];

            // Insert into orders table
            $insert_sql = "INSERT INTO orders (user_id, car_id, order_date) VALUES ('$user_id', '$car_id', NOW())";
            if ($conn->query($insert_sql) === TRUE) {
                // Delete from wishlist
                $delete_sql = "DELETE FROM wishlist WHERE id = '$process_id' AND user_id = '$user_id'";
                if ($conn->query($delete_sql) === TRUE) {
                    $_SESSION['success'] = "Car processed and moved to orders successfully.";
                } else {
                    $_SESSION['error'] = "Error removing car from wishlist: " . $conn->error;
                }
            } else {
                $_SESSION['error'] = "Error processing car: " . $conn->error;
            }
        } else {
            $_SESSION['error'] = "Car not found in wishlist.";
        }
    }
}

// Fetch wishlist items
$wishlist_sql = "SELECT w.id AS wishlist_id, c.id AS car_id, c.brand, c.model, c.price, c.image
                 FROM wishlist w
                 INNER JOIN cars c ON w.car_id = c.id
                 WHERE w.user_id = '$user_id'";
$wishlist_result = $conn->query($wishlist_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <style>
        /* Add your CSS styles here for wishlist page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .wishlist-item {
            border: 1px solid #ddd;
            margin-bottom: 10px;
            padding: 10px;
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 8px;
        }

        .car-image {
            width: 100px;
            height: auto;
            margin-right: 10px;
            border-radius: 6px;
        }

        .details {
            flex: 1;
        }

        .details p {
            margin: 5px 0;
            color: #666;
        }

        .remove-button, .process-button {
            background-color: #dc3545;
            color: #fff;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-left: 10px;
        }

        .process-button {
            background-color: #28a745;
        }

        .remove-button:hover {
            background-color: #c82333;
        }

        .process-button:hover {
            background-color: #218838;
        }

        .message {
            margin-top: 10px;
            padding: 10px;
            border-radius: 4px;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
    </style>

<script>
        function proceedToPayment(carId) {
            if (confirm('Are you sure you want to proceed to payment?')) {
                // AJAX request to remove the car from wishlist and redirect to orders.php
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = xhr.responseText;
                            if (response === 'success') {
                                // Redirect to orders.php
                                window.location.href = 'orders.php';
                            } else {
                                alert('Failed to proceed to payment. Please try again.');
                            }
                        } else {
                            alert('Failed to connect to server.');
                        }
                    }
                };
                xhr.open('POST', 'wishlist.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('process_id=' + encodeURIComponent(carId));
            }
        }

        // Adding event listener for Buy Now buttons
        document.addEventListener('DOMContentLoaded', function() {
            var buyNowButtons = document.querySelectorAll('.buy-now');
            buyNowButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var carId = this.getAttribute('data-car-id');
                    proceedToPayment(carId);
                });
            });
        });
    </script>
    
</head>
<body>
    <?php include 'header_customer.php'; ?>

    <div class="container">
        <h2>Wishlist</h2>

        <?php
        // Display success or error messages
        if (isset($_SESSION['success'])) {
            echo '<div class="message success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<div class="message error">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }

        if ($wishlist_result->num_rows > 0) {
            while ($row = $wishlist_result->fetch_assoc()) {
                echo '<div class="wishlist-item">';
                echo '<img src="' . $row['image'] . '" alt="' . $row['brand'] . ' ' . $row['model'] . '" class="car-image">';
                echo '<div class="details">';
                echo '<p><strong>' . $row['brand'] . ' ' . $row['model'] . '</strong></p>';
                echo '<p>Price: TZS ' . number_format($row['price']) . '</p>';
                echo '</div>';
                echo '<form action="wishlist.php" method="POST" style="margin: 0;">';
                echo '<input type="hidden" name="remove_id" value="' . $row['wishlist_id'] . '">';
                echo '<button type="submit" class="remove-button">Remove</button>';
                echo '</form>';
                // echo '<form action="wishlist.php" method="POST" style="margin: 0;">';
                // echo '<input type="hidden" name="process_id" value="' . $row['wishlist_id'] . '">';
                
                // echo '<button type="submit" class="process-button">Processed Payment</button>';
                // echo '</form>';

                echo '<button class="process-button buy-now" data-car-id="' . htmlspecialchars($row['wishlist_id']) . '" data-car-price="' . htmlspecialchars($row['price']) . '" style="display:none;">Buy Now</button>';

                echo '</div>';
            }
        } else {
            echo '<p>No items in wishlist.</p>';
        }
        ?>

        </section>
                <script src="https://pay.google.com/gp/p/js/pay.js" async></script>
                <!-- Include the separate Google Pay integration JavaScript file -->
                <script src="google_pay.js"></script>

            </div>

</body>
</html>

<?php
$conn->close();
?>
