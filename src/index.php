<?php

include './BD.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id_usuario'])){
        $query="select * from tbl_usuario where id_usuario=".$_GET['id_usuario'];
        $resultado=Get($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="select * from tbl_usuario";
        $resultado=Get($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $nombre=$_POST['nombre_usuario'];
    $cedula=$_POST['cedula_usuario'];
    $telefono=$_POST['telefono_usuario'];
    $email=$_POST['mail_usuario'];
    $query="insert into tbl_usuario(nombre_usuario, cedula_usuario, telefono_usuario,mail_usuario) values ('$nombre', '$cedula', '$telefono','$email')";
    $queryAutoIncrement="select MAX(id_usuario) as id from tbl_usuario";
    $resultado=Post($query, $queryAutoIncrement);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id=$_GET['id_usuario'];
    $nombre=$_POST['nombre_usuario'];
    $cedula=$_POST['cedula_usuario'];
    $telefono=$_POST['telefono_usuario'];
    $email=$_POST['mail_usuario'];
    $query="UPDATE tbl_usuario SET nombre_usuario='$nombre', cedula='$cedula', telefono='$telefono',email='$email' WHERE id_usuario='$id'";
    $resultado=Put($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $id=$_GET['id_usuario'];
    $query="DELETE FROM tbl_usuario WHERE id_usuario='$id'";
    $resultado=Delete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");


?>