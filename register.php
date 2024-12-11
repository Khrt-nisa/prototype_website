<?php
session_start(); // Untuk menggunakan session
require 'test.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);   

    if ($stmt->execute()) {
        $_SESSION['user'] = $name; // Simpan nama user di session
        header('Location: dashboard.php'); // Redirect ke dashboard
        exit();
    } else {
        $error = "Email sudah terdaftar!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Happy Kids Daycare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Register at Happy Kids Daycare</h1>
    </header>

    <main>
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </main>
    
    <footer>
        <p>&copy; 2024 Happy Kids Daycare. All rights reserved.</p>
    </footer>
</body>
</html>
