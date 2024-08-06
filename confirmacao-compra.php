<?php
session_start();

include_once 'conexao.php';
include_once 'cabecalho.php';
?>
<h4 class="bg-warning p-2">
    Confirmação de compra
</h4>

<p>
    Sua compra foi processada com sucesso. Abaixo estão os detalhes da sua compra
</p>

<?php
date_default_timezone_set('America/Sao_Paulo');
?>

<p><b>Data da compra: </b><?php echo date('d/m/Y'); ?></p>
<p><b>Nome do cliente: </b><?php echo $_GET['nome']; ?><br>
    <b>email: </b><?php echo $_GET['email']; ?><br>
    <b>CEP: </b><?php echo $_GET['cep']; ?> -
    <b>Número: </b><?php echo $_GET['numero']; ?><br>
    <b>Complemento: </b><?php echo $_GET['complemento']; ?>
</p>

<h4 class="bg-warning p-2">
    Itens comprados
</h4>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th class="align-middle">Produto</th>
            <th class="align-middle">Foto</th>
            <th class="align-middle">Quantidade</th>
            <th class="align-middle">Preço</th>
            <th class="align-middle">Subtotal</th>
        </tr>


        <?php
        //Variavel para calcular o total
        $total_compra = 0;

        //verificar se o carrinho existe na sessão

        if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
            foreach ($_SESSION['carrinho'] as $item) {
                $produto_id = $item['produto_id'];
                $quantidade_comprada = $item['quantidade'];

                //Consultar o banco para obter o nome do produto

                $consulta = 'SELECT * FROM tab_produtos WHERE id = :produto_id';
                $query = $bd->prepare($consulta);
                $query->bindParam(':produto_id', $produto_id, PDO::PARAM_INT);
                $query->execute();

                if ($query->rowCount() > 0) {
                    $produto = $query->fetch(PDO::FETCH_ASSOC);
                    $nome_produto = $produto['nome'];
                    $preco = $produto['preco'];
                    $foto = $produto['foto'];

                    //Calcular o subtotal para cada item
                    $subtotal = $preco * $quantidade_comprada;

                    echo '<tr>';
                    echo '<td class="align-middle">' . $nome_produto . '</td>';
                    echo '<td class="align-middle"><img src="img/' . $foto . '" width=75px></td>';
                    echo '<td class="align-middle text-center">' . $quantidade_comprada . '</td>';
                    echo '<td class="align-middle text-right">R$: ' . number_format($preco, 2, ",", ".") . '</td>';
                    echo '<td class="align-middle text-right">R$: ' . number_format($subtotal, 2, ",", ".") . '</td>';
                    echo '</tr>';
                }
                $total_compra += $subtotal;
            }

            //Atualiza a tabela de pedidos
            $ultimoid = $_GET['ultimoid'];

            $sql = 'UPDATE tab_pedidos SET total = ? WHERE id_pedido = ?';
            $query = $bd->prepare($sql);
            $query->bindParam(1, $total_compra, PDO::PARAM_STR);
            $query->bindParam(2, $ultimoid, PDO::PARAM_INT);
            $query->execute();
        }
        ?>
    </table>
</div>

<p class="bd-warning text-right p-2">
        <b>Total da compra: R$: <?php echo number_format($total_compra, 2, "," , ".")?></b>
</p>

<p>Obrigado pela sua compra!</p>

<?php 
    if (isset($_SESSION['carrinho'])) {
        unset($_SESSION['carrinho']);
    }
?>

<a href="./" class="btn btn-info btn-sm">Voltar</a>






<?php
include_once 'rodape.php';
?>