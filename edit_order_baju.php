<?php
session_start();

require 'config.php';

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    $orderBaju = $collectionOrder->findOne(['_id' => new MongoDB\BSON\ObjectId($order_id)]);
    
    if (!$orderBaju) {
        echo "Order Baju not found";
        exit();
    }

    if (isset($_POST['submit'])) {
        // Update data order baju
        $pilihanpaket = $_POST['pilihanpaket'];

        $updateResult = $collectionOrder->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($order_id)],
            ['$set' => [
                'pilihanpaket' => $pilihanpaket,
            ]]
        );

        if ($updateResult->getModifiedCount() > 0) {
            $_SESSION['success'] = "Order Baju data updated successfully";
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Failed to update order baju data";
        }
    }
} else {
    echo "Invalid request";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order Baju</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Additional styles for the Edit Order Baju form */
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
    background-image: url(https://img.freepik.com/free-photo/cyberpunk-urban-scenery_23-2150712616.jpg?t=st=1702360047~exp=1702363647~hmac=49fca833f88a15993f47f31ed98cb817232322a3144810e259d81758ab7a6664&w=1380);
}

.container {
    background-color: #0A99A1;
    margin-top: 50px;
    margin-bottom: 50px;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

h1 {
    color: #333;
}

.btn-primary {
    background-color: #5bc0de;
    color: white;
    margin-right: 10px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #333;
}

select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #3B58A5;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #4cae4c;
}

.btn-primary {
    background-color: #5bc0de;
    color: white;
    margin-right: 10px;
}

.btn-primary:hover {
    background-color: #46b8da;
}

.btn-secondary {
    background-color: #337ab7;
    color: white;
}

.btn-secondary:hover {
    background-color: #286090;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Order Baju</h1>
        <a href="dashboard.php" class="btn btn-primary">Kembali</a>

        <form method="POST">
            <div class="form-group">
               <h1> <label for="pilihanpaket">Pilihan Paket</label></h1>
                <select name="pilihanpaket" id="pilihanpaket" class="form-control">
                    <option value="Kemeja" <?= ($orderBaju['pilihanpaket'] === "Kemeja") ? 'selected' : '' ?>>Kemeja (Rp.80.000)</option>
                    <option value="Kaos" <?= ($orderBaju['pilihanpaket'] === "Kaos") ? 'selected' : '' ?>>Kaos (Rp.50.000)</option>
                    <option value="Jacket" <?= ($orderBaju['pilihanpaket'] === "Jacket") ? 'selected' : '' ?>>Jacket (Rp.200.000)</option>
                    <option value="Hoodie" <?= ($orderBaju['pilihanpaket'] === "Hoodie") ? 'selected' : '' ?>>Hoodie (Rp.150.000)</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-success">Update</button>
                <a href="dashboard.php" class="btn btn-primary">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
