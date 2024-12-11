<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Contoh autentikasi sederhana (ganti dengan database)
    $validEmail = "user@daycare.com";
    $validPassword = "password123";

    if ($email === $validEmail && $password === $validPassword) {
        $_SESSION['user'] = [
            'name' => 'Khoirotun Nisa',
            'email' => $email
        ];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Email atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Happy Kids Daycare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Login to Happy Kids Daycare</h1>
    </header>
    <main>
        <form action="" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>
    </main>
    <footer>
        <p>&copy; 2024 Happy Kids Daycare. All rights reserved.</p>
    </footer>
</body>
</html>
