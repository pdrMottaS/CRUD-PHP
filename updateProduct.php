<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    require_once 'database/connection.php';

    $id=$_GET['id'];
    if(isset($id)){
        $data = json_decode(file_get_contents("php://input"),true);
        $name = addslashes($data['name']);
        $description = addslashes($data['description']);
        $value=$data['value'];
        $connDB=new connDB();
        $conn=$connDB->connection();
        $stmt = $conn->prepare("UPDATE products SET name=':name',description=':description',value=':value' WHERE id=':id'");
        $stmt->bindValue(':id',$id);
        $stmt->bindValue(':name',$name);
        $stmt->bindValue(':description',$description);
        $stmt->bindValue(':value',$value);
        $result = $stmt->execute();
        if($result){
            if($result->rowCount()){
                header('HTTP/1.1 200 OK');
                echo json_encode(array("msg"=>"Produto alterado"));
            }else{
                header('HTTP/1.1 404 Not Found');
                echo json_encode(array("msg"=>"Produto não encontrado"));
            }
        }
        else{
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(array("msg"=>"Falha ao alterar produto"));
        }
    }
    else{
        header('HTTP/1.1 204 No Content');
        echo json_encode("Não foi definido um id");
    }
?>