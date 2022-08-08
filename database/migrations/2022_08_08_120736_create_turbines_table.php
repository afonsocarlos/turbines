<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Lib\Config;


$db = new PDO(Config::get('database'));

echo "Creating turbine_addresses table (if it doesn't exist)...\n";

// Create table turbine_addresses
$db->exec('CREATE TABLE IF NOT EXISTS turbine_addresses (
    id INTEGER PRIMARY KEY,
    name TEXT,
    description TEXT,
    latitude REAL,
    longitude REAL
)');

// Insert Initial Data
$addresses = [
    ['name' => 'Amaral1-1', 'description' => 'Gamesa', 'latitude' => '39.026628121', 'longitude' => '-9.048632539'],
    ['name' => 'Amaral1-2', 'description' => 'Gamesa', 'latitude' => '39.026352641', 'longitude' => '-9.046270410'],
    ['name' => 'Amaral1-3', 'description' => 'Gamesa', 'latitude' => '39.025990218', 'longitude' => '-9.044045397'],
    ['name' => 'Amaral1-4', 'description' => 'Gamesa', 'latitude' => '39.025786934', 'longitude' => '-9.041793910'],
    ['name' => 'Amaral1-5', 'description' => 'Gamesa', 'latitude' => '39.025322113', 'longitude' => '-9.036296175'],
];

echo "Inserting initial data into turbine_addresses table...\n";
$stmt = $db->prepare('INSERT INTO turbine_addresses (name, description, latitude, longitude) VALUES (:name, :description, :latitude, :longitude)');
foreach ($addresses as $address) {
    $stmt->execute($address);
}
echo "Done.\n";
