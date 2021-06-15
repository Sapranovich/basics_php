<?php 

$connection = new PDO("mysql:host=localhost;dbname=db;charset=utf8", "root", "mysql");

// Прямой запрос
// $query = "INSERT products (name_product, quantity, retail_price, trade_price) VALUE ('делаем тестовую запись', '000', '0000', '00000')";
// $count = $connection->exec($query);

// подготовленный запрос
$name_product = 'Lorem Lorem Lorem 32423423Lorem';
$quantity = 123;
$retail_price = 1233;
$trade_price = 3245;

$param = [
    'n' => $name_product,
    'q' => $quantity,
    'r' => $retail_price,
    't' => $trade_price
];


$sql = "INSERT products (name_product, quantity, retail_price, trade_price) VALUE (:n, :q, :r, :t)";
$query = $connection->prepare($sql);
$query->execute($param);




// echo $count;
