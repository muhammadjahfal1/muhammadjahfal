<?php

require_once __DIR__ . "/vendor/autoload.php";

use MongoDB\Client;

// Ganti URL dan nama database sesuai dengan konfigurasi MongoDB Anda
$mongoURL = "mongodb://localhost:27017";
$databaseName = "penjualan_baju";

// Buat koneksi MongoDB
$mongoClient = new Client($mongoURL);

// Pilih database
$database = $mongoClient->$databaseName;

// Pilih koleksi-koleksi yang diperlukan
$collectionPembeli = $database->pembeli;
$collectionOrder = $database->order;

?>
