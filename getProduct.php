<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    require_once 'database/connection.php';

    $id=$_GET['id'];
    if(isset($id)){
        $connDB=new connDB();
        $conn=$connDB->connection();
        $stmt=$conn->query("SELECT * FROM products WHERE id='".$id."'");
        $result=$stmt->fetchAll();
        if($result){
            header('HTTP/1.1 200 OK');
            echo json_encode($result);
        }
        else{
            header('HTTP/1.1 404 Not Found');
            echo json_encode("Nehum produto encontrado");
        }
    }
    else{
        header('HTTP/1.1 204 No Content');
        echo json_encode("Não foi definido um id");
    }
    
?>