<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Baca data transaksi dari file JSON
$file = 'transactions.json';
$transactions = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Daftar kategori untuk menampilkan nama kategori
$categories = [
    1 => 'Baby Care',
    2 => 'Toddler Activities',
    3 => 'Preschool Programs'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions - Happy Kids Daycare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo.webp" alt="Logo Happy Kids Daycare" style="width: 100px;">
        <h1>Transactions</h1>
        <nav>
            <a href="index.php">Home</a> | 
            <a href="dashboard.php">Dashboard</a> | 
            <a href="categories.php">Categories</a> | 
            <a href="transaction.php">Transactions</a> | 
            <form method="POST" action="dashboard.php" style="display:inline;">
                <button type="submit" name="logout">Logout</button>
            </form>
        </nav>
    </header>

    <main>
        <section>
            <h2>Transaction List</h2>
            <p>Here are the recorded transactions:</p>
            <table border="1" style="width:100%; text-align:left; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Parent Name</th>
                        <th>Child Name</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($transactions)): ?>
                        <tr>
                            <td colspan="7" style="text-align:center;">No transactions found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($transactions as $transaction): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($transaction['id']); ?></td>
                                <td><?php echo htmlspecialchars($transaction['parent_name']); ?></td>
                                <td><?php echo htmlspecialchars($transaction['child_name']); ?></td>
                                <td><?php echo htmlspecialchars($categories[$transaction['category_id']] ?? 'Unknown'); ?></td>
                                <td><?php echo htmlspecialchars(number_format($transaction['amount'], 2)); ?></td>
                                <td><?php echo htmlspecialchars($transaction['date']); ?></td>
                                <td>
                                    <form method="POST" action="delete-transaction.php" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $transaction['id']; ?>">
                                        <button type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <br>
            <a href="transaction-entry.php" style="display:inline-block; padding:10px 15px; background-color:green; color:white; text-decoration:none; border-radius:5px;">Add New Transaction</a>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Happy Kids Daycare. All rights reserved.</p>
    </footer>
</body>
</html>
