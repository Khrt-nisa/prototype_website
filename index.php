<?php
if (isset($_POST['name'])) {
    setcookie("user_name", $_POST['name'], time() + (86400 * 30), "/"); // Cookie berlaku 30 hari
    header("Location: index.php");
    exit();
}
$userName = $_COOKIE['user_name'] ?? 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Happy Kids Daycare - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welcome to Happy Kids Daycare</h1>
        <p>Hello, <?= htmlspecialchars($userName); ?>!</p>
        <nav>
            <a href="index.php">Home</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </nav>
    </header>
    <main>
        <form method="post">
            <label for="name">Enter your name:</label>
            <input type="text" id="name" name="name" required>
            <button type="submit">Save Name</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Happy Kids Daycare. All rights reserved.</p>
    </footer>
</body>
</html>
