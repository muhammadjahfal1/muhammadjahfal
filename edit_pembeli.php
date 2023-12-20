<?php
session_start();

require 'config.php';

if (isset($_GET['id'])) {
    $pembeli_id = $_GET['id'];
    $pembeli = $collectionPembeli->findOne(['_id' => new MongoDB\BSON\ObjectId($pembeli_id)]);

    if (!$pembeli) {
        echo "Pembeli not found";
        exit();
    }

    if (isset($_POST['submit'])) {
        // Update data pembeli
        $name = htmlspecialchars($_POST['name']);
        $nickgame = htmlspecialchars($_POST['nickgame']);
        $nomortelepon = htmlspecialchars($_POST['nomortelepon']);
        $email = htmlspecialchars($_POST['email']);
        $tanggalbeli = htmlspecialchars($_POST['tanggalbeli']);

        $updateResult = $collectionPembeli->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($pembeli_id)],
            ['$set' => [
                'name' => $name,
                'nomortelepon' => $nomortelepon,
                'email' => $email,
                'tanggalbeli' => $tanggalbeli,
            ]]
        );

        if ($updateResult->getModifiedCount() > 0) {
            $_SESSION['success'] = "Pembeli data updated successfully";
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Failed to update pembeli data";
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
    <title>Edit Pembeli</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url(https://img.freepik.com/free-photo/beautiful-anime-woman-cartoon-scene_23-2151035217.jpg?t=st=1702363174~exp=1702366774~hmac=b5eb27f362664e9d728231aa12223a801ac3eb93f7c5d43b8ea70542885c2728&w=1060);
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #3B58A5;
        }

        .btn-success {
            background-color: #3B58A5;
        }
#3B58A5
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Pembeli</h1>
        <a href="dashboard.php" class="btn btn-primary">Kembali</a>

        <form method="POST">
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" required="" class="form-control" value="<?= $pembeli['name'] ?>">
            </div>
            <div class="form-group">
                <label for="nomortelepon">Nomor Telepon</label>
                <input type="text" name="nomortelepon" required="" class="form-control" value="<?= $pembeli['nomortelepon'] ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" required="" class="form-control" value="<?= $pembeli['email'] ?>">
            </div>
            <div class="form-group">
                <label for="tanggalbeli">Tanggal Beli</label>
                <input type="text" name="tanggalbeli" required="" class="form-control" value="<?= $pembeli['tanggalbeli'] ?>">
            </div>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-success">Update</button>
                <a href="dashboard.php" class="btn btn-primary">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
