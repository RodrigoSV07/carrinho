<?php
include_once 'cabecalho.php';
include_once 'conexao.php';
if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha = hash('sha256', $senha);
    $cep = $_POST['cep'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];

    $sql = 'INSERT INTO tab_pessoas (nome, email, senha, cep, numero, complemento) VALUES (?, ?, ?, ?, ?, ?)';
    $query = $bd->prepare($sql);
    $query->bindParam(1, $nome, PDO::PARAM_STR);
    $query->bindParam(2, $email, PDO::PARAM_STR);
    $query->bindParam(3, $senha, PDO::PARAM_STR);
    $query->bindParam(4, $cep, PDO::PARAM_STR);
    $query->bindParam(5, $numero, PDO::PARAM_STR);
    $query->bindParam(6, $complemento, PDO::PARAM_STR);
    $query->execute();

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
        Pessoa cadastrada!
      </div>
      <div class="modal-footer">
        <a href="finalizar-compra.php" class="btn btn-secondary">Ok</a>
      </div>
    </div>
  </div>
</div>


<h5 class="alert alert-warning shadow-sm mt-5">
    <i class="fa-solid fa-floppy-disk"></i> Cadastro
</h5>

<form name="form1" id="form1" method="post">
    <div class="row">
        <div class="col-md-6">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" autofocus>
        </div>

        <div class="col-md-6">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control">
        </div>

        <div class="col-md-3">
            <label for="cep">CEP</label>
            <input type="text" name="cep" id="cep" class="form-control">
        </div>

        <div class="col-md-3">
            <label for="number">Número</label>
            <input type="text" name="numero" id="numero" class="form-control">
        </div>
    </div>

    <label for="text">Complemento</label>
    <input type="text" name="complemento" id="complemento" class="form-control">

    <button type="submit" name="submit" id="submit" class="btn btn-info mt-3">
        <i class="fa-solid fa-floppy-disk"></i> Salvar
    </button>

    <a href="finalizar-compra.php" class="btn btn-secondary mt-3">
        <i class="fa-solid fa-angles-left"></i> Voltar
    </a>
</form>





















<?php
include_once 'rodape.php';
?>