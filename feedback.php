<?php
$host = '127.0.0.1';
$dbname = 'haf-feedback';
$username = 'root';
$password = 'naaveeBismillah2019';
$charset = 'utf8mb4';
$collate = 'utf8mb4_unicode_ci';
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT => false,
    PDO::ATTR_EMULATE_PREPARES => true,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
];

$pdo = new PDO($dsn, $username, $password, $options);

$row = [
    'name' => filter_var($_POST['name'], FILTER_SANITIZE_STRING),
    'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
    'phone' => filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT),
    'subject' => filter_var($_POST['subject'], FILTER_SANITIZE_STRING),
    'message' => filter_var($_POST['message'], FILTER_SANITIZE_STRING)
];
$sql = "
    INSERT INTO 
        feedback 
    SET 
        name=:name, 
        email=:email, 
        phone=:phone, 
        subject=:subject, 
        message=:message;
";

$status = $pdo->prepare($sql)->execute($row);

if ($status) {
    echo (int)$pdo->lastInsertId();
}