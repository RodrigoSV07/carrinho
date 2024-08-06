<!DOCTYPE html>
<html lang="pt-BR" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de compras</title>
    <!-- Bootstrap --> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Font awesome --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS personalizado --> 
    <style>
      .produto{
        width: 250px;
        min-height: 400px;
        float: left;
        margin: 10px;
        padding: 10px;
        border: 1px solid #EEE;
        border-radius: 5px;
        overflow: hidden;
      }
      .produto img{
        transition: 0.5s ease;
      }
      .produto:hover{
        box-shadow: 0px 0px 30px #CCC;
      }
      .produto:hover img{
        transform: scale(1.2);
      }
    </style>
</head>
<body class="d-flex flex-column h-100">
    <h5 class="alert alert-info text-center mb-0">
        <i class="fa-solid fa-cart-shopping"></i> Sistema de compras
        <span class="float-right" data-toggle="tooltip" data-placement="left" title="Carrinho">
          <a href="carrinho.php" class="btn btn-warning btn-sm">
            <i class="fa-solid fa-cart-shopping"></i>
            <?php 
              // Verifica se a variável de sessão "carrinho" existe e se é um array
              if(isset($_SESSION['carrinho']) && 
                 is_array($_SESSION['carrinho'])){
                echo '<span class="badge badge-light" id="quantidadeNoCarrinho">';
                // Conta o número de itens no carrinho
                $numItensNoCarrinho = count($_SESSION['carrinho']);
                echo $numItensNoCarrinho;
                echo '</span>';
              }else{
                // Se o carrinho estiver vazio, mostrar 0
                echo '<span class="badge badge-light">';
                echo '0';
                unset($_SESSION['carrinho']);
                echo '</span>';
              }
            ?>
          </a>
        </span>
    </h5>




    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="banner/banner1.jpg" alt="Primeiro Slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="banner/banner2.jpg" alt="Segundo Slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="banner/banner3.jpg" alt="Terceiro Slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="banner/banner4.jpg" alt="Terceiro Slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Próximo</span>
  </a>
</div>

<main class="container mt-3">