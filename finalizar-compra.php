<?php 
    session_start();

    $logado = false;

    include_once 'conexao.php';
    include_once 'cabecalho.php';

    if(isset($_POST['logar'])){
      $email = isset($_POST['email']) ? $_POST['email'] : null;
      $senha = isset($_POST['senha']) ? hash('sha256', $_POST['senha']) : null;

      $query = $bd->prepare('SELECT * FROM tab_pessoas WHERE email = ?');
      $query->execute([$email]);
      $pessoa = $query->fetch(PDO::FETCH_ASSOC);

      if($pessoa){
        if($pessoa['senha'] == $senha){
          $id = $pessoa['id_pessoa'];
          $nome = $pessoa['nome'];
          $email = $pessoa['email'];
          $cep = $pessoa['cep'];
          $numero = $pessoa['numero'];
          $complemento = $pessoa['complemento'];
          $logado = true;
        }else{
          // Senha inválida
          echo '
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function(){
                $("#erro").modal("show");
            });
        </script>
        ';
        }
      }else{
        //Usuário não existe
        echo '
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function(){
                $("#naoexiste").modal("show");
            });
        </script>
        ';
      }
    }
?>


<!-- Modal de usuário ou senha inválido -->
<div class="modal fade" id="erro" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="TituloModalCentralizado">ATENÇÃO!!!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Usuário ou senha inválido
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal de usuário não cadastrado -->
<div class="modal fade" id="naoexiste" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="TituloModalCentralizado">ATENÇÃO!!!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Usuário não cadastrado!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>


<?php 
    if(!isset($_SESSION['carrinho'])){
        echo 'Seu carrinho está vazio! <a href="./" class="btn btn-secondary">Voltar</a>';
    }else{
        // Variável para calcular o total da compra
        $total = 0;

        $carrinho = $_SESSION['carrinho'];
        echo '<h4 class="bg-warning p-2">
                Resumo da compra</h4>';
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
                $total += $subtotal;

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

                
                echo '</tr>';
            }else{
                echo 'Produto não encontrado!';
            }
        }

        echo '</table></div><br>';

        // Mostrar o total da compra
        echo '<p class="bg-secondary p-2 text-right text-light"><b>Total da compra: R$ ' . number_format($total, 2, ",", ".") . '</b></p>';

        echo 'Para continuar, faça seu login ou 
              <a href="cadastro.php">cadastre-se</a>';
        echo '<div class="row">';
        echo '<div class="col">';
        echo '<form name="form1" id="form1" method="post" 
                    class="form-inline">';
        echo '<input type="email" name="email" id="email" 
                     placeholder="E-mail" class="form-control mr-1">';
        echo '<input type="password" name="senha" id="senha" 
                     placeholder="Senha" class="form-control mr-1">';
        echo '<input type="submit" name="logar" id="logar" 
                     class="btn btn-info" value="Logar">';
        echo '</form></div>';

        if($logado == true){
            echo '<div class="col text-right">';
            echo '<form method="post" action="processar-compra.php">';
            echo '<input type="hidden" name="id" value="' . $id . '">';
            echo '<input type="hidden" name="nome" value="' . $nome . '">';
            echo '<input type="hidden" name="email" value="' . $email . '">';
            echo '<input type="hidden" name="cep" value="' . $cep . '">';
            echo '<input type="hidden" name="numero" value="' . $numero . '">';
            echo '<input type="hidden" name="complemento" value="' . $complemento . '">';
            echo '<input type="submit" class="btn btn-info" value="Finalizar compra">';
            echo '</form></div></div>';
        }
        echo '<div class="col text-right"></div></div>';
    }
?>




<?php 
    include_once 'rodape.php';
?>