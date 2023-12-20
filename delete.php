<?php
session_start();

require 'config.php';

if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];

    if ($type === 'pembeli') {
        // Hapus data pembeli
        $deleteResult = $collectionPembeli->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    } elseif ($type === 'order') {
        // Hapus data order
        $deleteResult = $collectionOrder->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    } else {
        echo "Invalid request";
        exit();
    }

    if ($deleteResult->getDeletedCount() > 0) {
        $_SESSION['success'] = "Data deleted successfully";
    } else {
        $_SESSION['error'] = "Failed to delete data";
    }

    header("Location: dashboard.php");
    exit();
} else {
    echo "Invalid request";
    exit();
}
?>

<!-- HTML Code ... (Tidak ada perubahan pada bagian HTML) -->
