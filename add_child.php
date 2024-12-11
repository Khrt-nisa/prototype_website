<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $parent_name = $_POST['parent_name'];

    $stmt = $conn->prepare("INSERT INTO children (name, age, parent_name) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $name, $age, $parent_name);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Failed to add child.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Child</title>
</head>
<body>
    <h1>Add New Child</h1>
    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" required><br>
        <label>Age:</label><br>
        <input type="number" name="age" required><br>
        <label>Parent Name:</label><br>
        <input type="text" name="parent_name" required><br><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>
