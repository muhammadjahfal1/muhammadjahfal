\<?php
require 'config.php';

$pipeline = [
    [
        '$lookup' => [
            'from' => 'order',
            'localField' => '_id',
            'foreignField' => 'order_id',
            'as' => 'orderBajuData',
        ],
    ],
    [
        '$unwind' => [
            'path' => '$orderBajuData',
            'preserveNullAndEmptyArrays' => true,
        ],
    ],
    [
        '$project' => [
            'name' => 1,
            'nomortelepon' => 1,
            'email' => 1,
            'tanggalbeli' => 1,
            'orderBajuData.pilihanpaket' => 1,
            'orderBajuData._id' => 1,
        ],
    ],
];

$cursor = $collectionPembeli->aggregate($pipeline);

$pembeliOrderBajuData = iterator_to_array($cursor);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #495057;
             background-image: url(https://img.freepik.com/free-photo/neon-light-girl-ai-generated-image_268835-6482.jpg?t=st=1702357732~exp=1702361332~hmac=6b0be44cc4d2013b21cf400b53c8a8edef84644fae296b939de6e451b3ffc05e&w=1060);
        }

        .container {
            margin: 50px auto;
            padding: 20px;
            border-radius: 50px;
            box-shadow: 0 0 10px rgba(, 0, 0, 0.2);
            background-color: #0A99A1;

        }

        h1, h2, h3, h4 {
            color: #000000;
        }

        .btn-primary {
            background-color: #0A99A1;
            border-color: #FBFF00;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #ffffff;
            color: #ffffff;
        }

        .card-body {
            padding: 20px;
        }

        .text-center {
            text-align: center;
        }

        .btn-pesan {
            background-color: #3B58A5;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Data Pembeli</h1>

        

        <div class="card">
            <div class="card-header">
                
            </div>
            <div class="card-body">
                <?php foreach ($pembeliOrderBajuData as $data): ?>
                    <div class="card">
                        <div class="card-body">
                            <h3>Nama: <?= $data['name'] ?></h3>
                            <p>Nomor Telepon: <?= $data['nomortelepon'] ?></p>
                            <p>Email: <?= $data['email'] ?></p>
                            <p>Tanggal Beli: <?= $data['tanggalbeli'] ?></p>
                            <?php if (!empty($data['orderBajuData'])): ?>
                                <h4>Order Baju Data:</h4>
                                <p>Pilihan Paket: <?= $data['orderBajuData']['pilihanpaket'] ?></p>
                                <a href="edit_order_baju.php?id=<?= $data['orderBajuData']['_id'] ?>" class="btn btn-primary btn-action">Edit Order Baju</a>
                            <?php else: ?>
                                <p>No Order Baju Data</p>
                            <?php endif; ?>
                            <a href="edit_pembeli.php?id=<?= $data['_id'] ?>" class="btn btn-primary btn-action">Edit Pembeli Data</a>
                            <a href="delete.php?type=pembeli&id=<?= $data['_id'] ?>" class="btn btn-danger btn-action">Hapus</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="text-center">
            <a href="create_pembeli.php" class="btn btn-pesan btn-lg">Pesan Sekarang</a>
        </div>
    </div>
</body>
</html>
