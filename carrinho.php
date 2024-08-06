<?php 
    session_start();

    include_once 'conexao.php';
    include_once 'cabecalho.php';

    // Verificar se o carrinho existe na sessão
    if(!isset($_SESSION['carrinho'])){
        echo '
            <h5 class="alert alert-warning">Seu carrinho está vazio!
                <span class="float-right">
                    <a href="./" class="btn btn-secondary btn-sm">
                        Voltar
                    </a>
                </span>
            </h5>
        ';
    }else{
        $carrinho = $_SESSION['carrinho'];
        echo '<h4 class="bg-warning p-2">
                <i class="fa-solid fa-cart-shopping"></i> Produtos no carrinho</h4>';
        echo '<div class="table-responsive">';
        echo '<table class="table 
                            table-bordered 
                            table-striped 
                            table-hover">';
        echo '<tr>';
        echo '<th>Produto</th>';
        echo '<th class="text-center">Quantidade</th>';
        echo '<th class="text-center">Preço unitário</th>';
        echo '<th class="text-center">Subtotal</th>';
        echo '<th class="text-center">Ação</th>';
        echo '</tr>';

        foreach($carrinho as $item){
            $produto_id = $item['produto_id'];
            $quantidade = $item['quantidade'];

            // Consulta o banco de dados para obter informações do produto com base no seu ID
            $sql = 'SELECT nome, preco FROM tab_produtos WHERE id = :id';
            $query = $bd->prepare($sql);
            $query->bindParam(':id', $produto_id, PDO::PARAM_INT);
            $query->execute();

            if($query->rowCount() > 0){
                $produto = $query->fetch(PDO::FETCH_ASSOC);
                $nome_produto = $produto['nome'];
                $preco_unitario = $produto['preco'];

                $subtotal = $preco_unitario * $quantidade;

                echo '<tr>';
                if(strlen($nome_produto) > 35){
                    $novoTexto = substr(strtoupper($nome_produto),0, 35) . " ...";
                }else{
                    $novoTexto = strtoupper($nome_produto);
                }
                echo '<td data-toggle="tooltip" 
                          data-placement="top" 
                          title="'.$nome_produto.'">' . $novoTexto . '</td>';
                echo '<td class="text-center">' . $quantidade . '</td>';
                echo '<td class="text-right">R$ ' . number_format($preco_unitario, 2, ",", ".") . '</td>';
                echo '<td class="text-right">R$ ' . number_format($subtotal, 2, ",", ".") . '</td>';

                echo '<td class="text-center">
                        <a href="remover-do-carrinho.php?produto_id='.$produto_id.'">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                      </td>';
                echo '</tr>';
            }else{
                echo 'Produto não encontrado!';
            }
        }

        echo '</table></div><br>';
        echo '<a href="./" class="btn btn-success">Continuar comprando</a> ';
        echo '<a href="finalizar-compra.php" class="btn btn-info">Finalizar compra</a>';
         
    }
?>




<?php 
    include_once 'rodape.php';
?>