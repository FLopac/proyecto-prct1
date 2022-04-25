<?php
    //print_r($_POST);
    session_start();
    $usuario = $_SESSION['username'];
    if(!isset($usuario)){
        header("location: ../login.php");
    }else{
        if(empty($_POST["oculto"]) || empty($_POST["txtNombre"]) || empty($_POST["txtEdad"]) || empty($_POST["txtSigno"])){
            header('Location: index.php?mensaje=falta');
            exit();
        }
        
        include_once 'model/conexion.php';
        $nombre = $_POST["txtNombre"];
        $edad = $_POST["txtEdad"];
        $signo = $_POST["txtSigno"];
        
        $sentencia = $bd->prepare("INSERT INTO empleado(nombre,edad,signo) VALUES (?,?,?);");
        $resultado = $sentencia->execute([$nombre,$edad,$signo]);
        
        if ($resultado === TRUE) {
            header('Location: index.php?mensaje=registrado');
        } else {
            header('Location: index.php?mensaje=error');
        }
    }
    
    
?>