<?php 
    session_start();
    include_once 'conexao.php';

    //Verificar se o carrinho existe na sessão

    if (!isset($_SESSION['carrinho'])) {
        //redirecionar para a página inicial
        header('location: ./');
        exit();
    }

    //Processar a compra
    if (isset($_SESSION['carrinho'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cep = $_POST['cep'];
        $numero = $_POST['numero'];
        $complemento = $_POST['complemento'];date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');

        //Gravar o pedido
        $sql = 'INSERT INTO tab_pedidos (id_pessoa, data) VALUES (?, ?)';
        $query = $bd->prepare($sql);
        $query->bindParam(1, $id, PDO::PARAM_INT);
        $query->bindParam(2, $data, PDO::PARAM_STR);
        $query->execute();
        


        //Resgatar o ultimo id gerado na tabela de pedidos
        $ultimoid = $bd->lastInsertId();

        //Dar baixa na tabela de produtos para cada item no carrinho
        foreach($_SESSION['carrinho'] as $item){
            $produto_id = $item['produto_id'];
            $quantidade_comprada = $item['quantidade'];

            //Atualizar a coluna estoque da tabela de produtos

            $sql = 'UPDATE tab_produtos SET estoque = estoque - :quantidade_comprada WHERE id = :produto_id';
            $query = $bd->prepare($sql);
            $query->bindParam(':quantidade_comprada', $quantidade_comprada, PDO::PARAM_INT);
            $query->bindParam(':produto_id', $produto_id, PDO::PARAM_INT);
            $query->execute();


            //inserir os itens na tabela itens pedidos

            $sql2 = 'INSERT INTO tab_itens_pedido (id_pedido, id_produto, qtde) VALUES (?, ?, ?)';
            $query2 = $bd->prepare($sql2);
            $query2->bindParam(1, $ultimoid, PDO::PARAM_INT);
            $query2->bindParam(2, $produto_id, PDO::PARAM_INT);
            $query2->bindParam(3, $quantidade_comprada, PDO::PARAM_INT);
            $query2->execute();
        }
    }

    //Escrever mensagem de confirmação de compra
    header("Location: confirmacao-compra.php?id=$id&nome=$nome&email=$email&cep=$cep&numero=$numero&complemento=$complemento&ultimoid=$ultimoid");
?>









