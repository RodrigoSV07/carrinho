<?php 
    session_start();

    // Verifica se o carrinho existe na sessão
    if(isset($_SESSION['carrinho'])){
        $produto_id = $_GET['produto_id'];

        // Percorrer o carrinho para encontrar o índice do item a ser removido
        foreach($_SESSION['carrinho'] as $indice => $item){
            if($item['produto_id'] == $produto_id){
                // Remove o item do carrinho
                unset($_SESSION['carrinho'][$indice]);
                // Sai do loop após a remoção
                break;
            }
        }

        if(empty($_SESSION['carrinho'])){
            unset($_SESSION['carrinho']);
        }
    }

    // Redireciona para a página carrinho
    header('Location: carrinho.php');
    exit();
?>