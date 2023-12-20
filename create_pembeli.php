<?php
session_start();

if (isset($_POST['submit'])) {
    require 'config.php';

    $name = htmlspecialchars($_POST['name']);
    $nomortelepon = htmlspecialchars($_POST['nomortelepon']);
    $email = htmlspecialchars($_POST['email']);
    $tanggalbeli = htmlspecialchars($_POST['tanggalbeli']);
    
    $insertOneResultPembeli = $collectionPembeli->insertOne([
        'name' => $name,
        'nomortelepon' => $nomortelepon,
        'email' => $email,
        'tanggalbeli' => $tanggalbeli,
    ]);

    $_SESSION['pembeli_id'] = (string) $insertOneResultPembeli->getInsertedId();
    header("Location: create_order_baju.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jahfal Fasion - Tambah Pembeli</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            background-image: url(https://img.freepik.com/free-photo/beautiful-anime-woman-cartoon-scene_23-2151035215.jpg?t=st=1702361698~exp=1702365298~hmac=1a51d9833c2aa374113892fc0368a13748188b11d52835b598a9404b3ef3141e&w=1060);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #0A99A1;
            padding: 20px;
            border-radius: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 80%;
            
        }

        .container h1 {
            color: white; /* Set the color of the h1 text to white */
        }

        form {
            margin-bottom: 10px;
        }

        form label {
            display: block;
            margin-bottom: 10px;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        form button {
            background-color: #3B58A5;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #3B58A5;
            color: white;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Tambah Pembeli</h1>
        <a href="dashboard.php" class="btn btn-primary">Kembali</a>

        <form method="POST">
            <div>
                <label for="name">Nama</label>
                <input type="text" name="name" required="" placeholder="Nama">
            </div>
            <div>
                <label for="nomortelepon">Nomor Telepon</label>
                <input type="text" name="nomortelepon" required="" placeholder="Nomor Telepon">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" required="" placeholder="Email">
            </div>
            <div>
                <label for="tanggalbeli">Tanggal Beli</label>
                <input type="text" name="tanggalbeli" required="" placeholder="Tanggal Beli">
            </div>

            <div>
                <button type="submit" name="submit">Submit</button>
                <a href="dashboard.php" class="btn btn-primary">Kembali</a>
            </div>
        </form>
    </div>
</body>

</html>
