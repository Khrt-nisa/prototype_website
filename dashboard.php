<?php
session_start();

// Proses logout jika tombol logout diklik
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// Check if the user is logged in
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "happydaycare";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk menghitung jumlah data di tabel 'categories'
$sql_categories = "SELECT COUNT(*) AS total FROM categories";
$result_categories = $conn->query($sql_categories);
$total_categories = ($result_categories->num_rows > 0) ? $result_categories->fetch_assoc()['total'] : 0;

// Query tambahan untuk tabel 'transactions'
$sql_transactions = "SELECT COUNT(*) AS total FROM transactions";
$result_transactions = $conn->query($sql_transactions);
$total_transactions = ($result_transactions->num_rows > 0) ? $result_transactions->fetch_assoc()['total'] : 0;

$conn->close(); // Tutup koneksi database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Happy Kids Daycare</title>
    <link rel="stylesheet" href="style.css">
    <style>
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
        }
        header img {
            width: 100px;
        }
        nav a, nav button {
            text-decoration: none;
            color: white;
            background-color: #45a049;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            margin: 0 5px;
            cursor: pointer;
        }
        nav a:hover, nav button:hover {
            background-color: #3e8e41;
        }
        .dashboard-nav {
            margin: 20px 0;
            display: flex;
            gap: 10px;
        }
        .dashboard-nav a {
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            transition: 0.3s ease-in-out;
        }
        .dashboard-nav a:hover {
            background-color: #0056b3;
        }
        section h3 {
            margin-top: 30px;
        }
        div[style*="display: flex"] > div {
            flex: 1;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }
        div[style*="display: flex"] > div:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <header>
        <img src="logo.webp" alt="Logo Happy Kids Daycare">
        <h1>Dashboard</h1>
        <nav>
            <a href="index.php">Home</a>
            <form method="POST" style="display:inline;">
                <button type="submit" name="logout">Logout</button>
            </form>
        </nav>
    </header>

    <main>
        <section>
            <h2>Welcome, 
                <?php 
                    echo htmlspecialchars(isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : 'Admin');
                ?>
            </h2>
            <p>Here you can manage your daycare account and view the services available.</p>
        </section>
        
        <!-- Navigasi tambahan -->
        <div class="dashboard-nav">
            <a href="categories.php">Manage Categories</a>
            <a href="categories-entry.php">Add New Category</a>
            <a href="transaction.php">View Transactions</a>
        </div>

        <!-- Dashboard Widgets -->
        <section>
            <h3>Dashboard Widgets</h3>
            <div style="display: flex; gap: 20px;">
                <!-- Widget Categories -->
                <div>
                    <h4>Total Categories</h4>
                    <p style="font-size: 24px; font-weight: bold;"><?php echo $total_categories; ?></p>
                </div>

                <!-- Widget Transactions -->
                <div>
                    <h4>Total Transactions</h4>
                    <p style="font-size: 24px; font-weight: bold;"><?php echo $total_transactions; ?></p>
                </div>
            </div>
        </section>

        <!-- Aktivitas -->
        <section>
            <h3>Our Activities</h3>
            <div class="kegiatan">
                <img src="kegiatan1.webp" alt="Activity 1" style="width: 300px; height: 200px; object-fit: cover;">
                <img src="kegiatan2.jpeg" alt="Activity 2" style="width: 300px; height: 200px; object-fit: cover;">
                <img src="kegiatan3.jpeg" alt="Activity 3" style="width: 300px; height: 200px; object-fit: cover;">
            </div>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 Happy Kids Daycare. All rights reserved.</p>
    </footer>
</body>
</html>





