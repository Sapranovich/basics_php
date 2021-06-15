<?php
$driver = 'mysql';
$host = 'localhost';
$db_name = 'dinamic_site';
$db_user = 'root';
$db_pass = 'mysql';
$charset = 'utf8';

$opions = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try{
    $pdo = new PDO("$driver:host=$host;dbname=$db_name;charset=$charset", $db_user, $db_pass, $opions);
} catch (PDOException $i){
    die("Ошибка подключения к базе данных");
}

?>