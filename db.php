<?php
$host = 'sql105.infinityfree.com';
$db = 'if0_37934099_CRUD';
$user = 'if0_37934099';
$pass = 'B6pmtVTWYMtB';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>