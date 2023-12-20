<?php
session_start();

if (isset($_POST['submit'])) {
    require 'config.php';

    $insertOneResultOrder = $collectionOrder->insertOne([
        'order_id' => new MongoDB\BSON\ObjectId($_SESSION['pembeli_id']),
        'pilihanpaket' => $_POST['pilihanpaket'],
    ]);

    $_SESSION['success'] = "Order data created successfully";
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan Baju</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: white;
            margin-top: 50px;
            margin-bottom: 50px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        form {
            margin-bottom: 20px;
        }
        form label {
            display: block;
            margin-bottom: 8px;
        }
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        form button {
            background-color: #5cb85c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #5bc0de;
            color: white;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Baju</h1>
        <a href="dashboard.php" class="btn btn-primary">Kembali</a>

        <form method="POST">
            <div>
                <label for="pilihanpaket">Pilihan Baju</label>
                <select name="pilihanpaket" id="pilihanpaket" class="form-control">
                    <option value="Kemeja">Kemeja   (Rp.80.000)</option>
                    <option value="Kaos">Kaos       (Rp.50.000)</option>
                    <option value="Jacket">Jacket   (Rp.200.000)</option>
                    <option value="Hoodie">Hoodie   (Rp.150.000)</option>
                </select>
            </div>

            <div>
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                <a href="dashboard.php" class="btn btn-primary">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
