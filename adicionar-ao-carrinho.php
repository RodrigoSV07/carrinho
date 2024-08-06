<?php
session_start();

//Verificar se o carrinho existe na sessão, se não criar//

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

//Obter o ID e a quantidade de produtos selecionado

if (isset($_POST['id']) && isset($_POST['quantidade'])) {
    $produto_id = $_POST['id'];
    $quantidade = $_POST['quantidade'];


    //Adicionar o produto ao carrinho
    $_SESSION['carrinho'][] = array('produto_id' => $produto_id, 'quantidade' => $quantidade);

    // Redirecionar para a paginar anterior
    header('Location: index.php?ok');
    exit();
}
