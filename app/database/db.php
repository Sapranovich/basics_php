<?php
require('connect.php');

function tt($value)
{
    echo '<pre>';
    print_r($value);
    echo '<pre>';
}

// Проверка выполнения запроса к БД
function dbCheckError($query)
{
    $errorInfo = $query->errorInfo();

    if ($errorInfo[0] !== PDO::ERR_NONE) {
        echo $errorInfo[2];
        exit();
    }
    return true;
}

// Запрос на получение данных одной таблицы
function selectAll($table, $params = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";
    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'".$value."'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key=$value";
            } else {
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        };
    };
    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);
    return $query->fetchAll();
}

$params = [
   'admin'=>1,
   'username'=>'Andrei'
];

// tt(selectAll('users', $params));

// Запрос на получение одной строки с выбранной таблицы
function selectOne($table, $params = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";
    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'".$value."'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key=$value";
            } else {
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        };
    };
    // $sql = $sql . " LIMIT 1";

    //  tt($sql);
    //  exit();
    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);
    return $query->fetch();
}

// tt(selectOne('users'));


function insert($table, $params)
{
    global $pdo;
    $i=0;
    $coll='';
    $mask='';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $coll = $coll . "$key";
            $mask = $mask . "'" . "$value" . "'";
        } else {
            $coll = $coll . ", $key";
            $mask = $mask . ", " . "'" . $value . "'";
        }
        $i++;
    }

    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";

    // tt($sql);
    // exit();
    $query = $pdo->prepare($sql);
    $query->execute($params);
    dbCheckError($query);
}


$arrData = [
  'admin' => '0',
  'username' => '123213',
  'email' => 'ads@a32313123123213sd.asd',
  'password' => 'dsad'
];

// insert('users', $arrData);

// обновление строки в таблице
function update($table, $id, $params)
{
    global $pdo;
    $i=0;
    $str='';
    foreach ($params as $key => $value) {
        if ($i === 0) {
           $str = $str . $key . " = '" . $value . "'";
        } else {
            $str = $str . ", " . $key . " = '" . $value . "'";
        }
        $i++;
    }
    $sql = "UPDATE $table SET $str WHERE id = $id";

    // tt($sql);
    // exit();
    $query = $pdo->prepare($sql);
    $query->execute($params);
    dbCheckError($query);
};

function delete($table, $id)
{
    global $pdo;
    
    $sql = "DELETE FROM $table WHERE id = $id";
    $query = $pdo->prepare($sql);
    $query->execute($params);
    dbCheckError($query);
}

delete('users', 1);
