<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    require_once 'database/connection.php';
    require_once 'utils/generateKey.php';

    $data = json_decode(file_get_contents("php://input"),true);
    $id=chave();
    $name = addslashes($data['name']);
    $description = addslashes($data['description']);
    $value=$data['value'];

    $connDB = new connDB();
    $conn = $connDB->connection();
    $stmt=$conn->prepare("INSERT INTO products(id,name,description,value) VALUES(:id,:name,:description,:value)");
    $stmt->bindValue(':id',$id);
    $stmt->bindValue(':name',$name);
    $stmt->bindValue(':description',$description);
    $stmt->bindValue(':value',$value);
    $result=$stmt->execute();
    
    if($result){
        header('HTTP/1.1 200 OK');
        echo json_encode(array("msg"=>"Novo produto criado !!!"));
    }
    else{
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(array("msg"=>"Falha ao criar produto"));
    }
?>