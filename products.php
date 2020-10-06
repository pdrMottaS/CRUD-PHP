<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    require_once 'database/connection.php';

    $connDB=new connDB();
    $conn=$connDB->connection();
    $query=$conn->query("SELECT * FROM products");
    $result=$query->fetchAll();

    if(count($result)>0){
        header('HTTP/1.1 200 OK');
        echo json_encode($result);
    }else{
        header('HTTP/1.1 404 Not Found');
    }
?>