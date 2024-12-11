<?php
require 'db.php';

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM children WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: dashboard.php");
    exit();
} else {
    echo "Failed to delete child.";
}
?>
