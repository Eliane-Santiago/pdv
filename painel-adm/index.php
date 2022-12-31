<?php
//INCLUINDO O ARQUIVO DE CONFIGURAÇÃO
require_once('../config.php'); //ARQUIVO CONFIG ESTÁ NO DIRETÓRIO ANTERIOR

//VARIÁVEIS DO MENU ADMINISTRATIVO
$menu1 = 'home';
$menu2 = 'usuarios';

  //Mastra a versão do php que está rodando
  //phpinfo();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Painel Administrativo</title>
	<!--CDN BOOTSTRAP-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
	rel="stylesheet" 
	integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" 
	crossorigin="anonymous">
  <!--CDN SCRIPT BOOTSTRAP-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" 
  crossorigin="anonymous"></script>
  <!--SCRIPT CDN JQUERY E AJAX-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!--DATATABLES BOOTSTRAP 5 VIA DOWLOAND-->
  <link rel="stylesheet" type="text/css" href="../DataTabels-Traduzido/datatables.min.css"/>
  <script type="text/javascript" src="../DataTabels-Traduzido/datatables.min.js"></script>
</head>
<body>


	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Administrador</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php?pagina=<?php echo $menu1 ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?pagina=<?php echo $menu2 ?>">Usuários</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>

        </ul>
        <div class="d-flex mx-3"><!--INICIO: DIV LOGO LADO DIREITO / BARRA DE MENU-->
          <!--IMAGEM DA BARRA INICIAL LADO DIREITO / BARRA DE MENU-->
          <img src="../img/icone-user.png" width="40px" height="40px">

          <!--OPÇÕES DE MENU LADO DIREITO-->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Administrador
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="#">Editar Perfil</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Sair</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div><!--FIM: DIV LOGO LADO DIREITO / BARRA DE MENU-->
      </div>
    </div>
  </nav>
  <!--LOCAL ONDE AS PÁGINAS SERÃO INCLUÍDAS-->
  <div class="container-fluid mt-4 mx-3">
    <?php
    if(@$_GET['pagina'] == $menu1){
      require_once($menu1 .'.php');   
    } 
    else if(@$_GET['pagina'] == $menu2){
      require_once($menu2 .'.php');
    }

    ?>
  </div>


  

</body>
</html>