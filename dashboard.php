<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
require 'connect.php';

$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_data'])) {
    
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $phone = $_SESSION['phone'];
    $address = $_SESSION['address'];
    $dob = $_SESSION['dob'];
    $password = $_SESSION['password']; 

    
    $sql = "INSERT INTO session_users (username, email, first_name, last_name, phone, address, dob, password) 
            VALUES ('$username', '$email', '$first_name', '$last_name', '$phone', '$address', '$dob', '$password')";

    if ($conn->query($sql) === TRUE) {
        $message = "User information saved successfully!";
    } else {
        $message = "Error saving data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>User Dashboard</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Welcome, <?php echo $_SESSION['first_name']; ?>!</h2>
        <?php if ($message) echo "<div class='alert alert-success'>$message</div>"; ?>
        
        <h4>Your Details:</h4>
        <p><strong>Username:</strong> <?php echo $_SESSION['username']; ?></p>
        <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
        <p><strong>First Name:</strong> <?php echo $_SESSION['first_name']; ?></p>
        <p><strong>Last Name:</strong> <?php echo $_SESSION['last_name']; ?></p>
        <p><strong>Phone:</strong> <?php echo $_SESSION['phone']; ?></p>
        <p><strong>Address:</strong> <?php echo $_SESSION['address']; ?></p>
        <p><strong>Date of Birth:</strong> <?php echo $_SESSION['dob']; ?></p>

        <form method="POST" action="">
            <button type="submit" name="save_data" class="btn btn-success">Save Your Information</button>
        </form>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
