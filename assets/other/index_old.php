<?php 
require_once 'setting.php';

$connection = new mysqli($host, $user, $pass, $data);
if($connection->connect_error) die('Error connection');


$query = "SELECT * FROM products";
$resault = $connection->query($query);

if(!$resault) die('Error select');

$rows = $resault->num_rows;
for ($i = 0; $i < $rows; ++$i){
    $resault->data_seek($i);
    echo 'Test alert ' . $resault->fetch_assoc()['name_product'] . '<br>';
}

$resault->close();
$connection->close();


// echo '<pre>';
// print_r($rows);
// echo '<pre>';

