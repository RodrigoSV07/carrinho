<?php 
    session_start();
    include_once 'conexao.php';
    include_once 'cabecalho.php';

    if(isset($_GET['ok'])){
        echo '
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function(){
                $("#confirmar").modal("show");
            });
        </script>
        ';
    }
?>



<!-- Modal -->
<div class="modal fade" id="confirmar" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title text-light" id="TituloModalCentralizado">Carrinho</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Produto adicionado ao carrinho
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>






    <?php 
        try{
            $sql = 'SELECT * FROM tab_produtos';
            $query = $bd->prepare($sql);
            $query->execute();

            if(isset($query)){
                while($linha = $query->fetch(PDO::FETCH_ASSOC)){
                    echo "<div class='produto'>";
                    echo "<p class='text-center'><img src='img/".$linha["foto"]."' width='180' height='180'></p>";
                    echo "<p>";
                    // Verifica se o texto é maior que 35 caracteres, se for, corta e concatena com reticências
                    if(strlen($linha["nome"]) > 35){
                        $novoTexto = substr(strtoupper($linha["nome"]),0, 35) . " ...";
                    }else{
                        $novoTexto = strtoupper($linha["nome"]);
                    }
                    echo "<b class='text-primary'>".$novoTexto."</b><br>";
                    echo "<b class='text-danger' style='font-size: 20px'>R$ " . $linha["preco"] . "</b><br>";
                    echo "<span class='muted'>Estoque: " . $linha["estoque"] . "</span>";
                    echo "<div>";
                    echo "<form method='post' action='adicionar-ao-carrinho.php'>";
                    echo "<input type='hidden' name='id' value='" . $linha["id"] . "'>";
                    if($linha["estoque"] <= 0){
                        echo "<br>";
                        echo "Produto <span class='text-danger'><b>INDISPONÍVEL</b></span>";
                    }else{
                        echo "Quantidade: <input type='number' name='quantidade' value='1' min='1' max='" . $linha["estoque"] . "'><br>";
                        echo "<p class='text-center mb-0'><input type='submit' value='Adicionar ao carrinho' class='btn btn-info btn-sm mt-2'></p>";
                    }
                    echo "</form></div></div>";
                }
            }else{
                echo "<p class='text-center text-danger'>Não há produtos cadastrados!</p>";
            }
        }catch(PDOException $e){
            $e->getMessage();
        }
    ?>


<?php 
    include_once 'rodape.php';
?>