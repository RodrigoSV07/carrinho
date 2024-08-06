<?php 
    try{
        $servidor = 'localhost';
        $usuario = 'root';
        $senha = '';
        $banco = 'carrinho';

        $bd = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>