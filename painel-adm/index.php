<?php

//INICIANDO A VARIÁVEL DE SESSÃO
@session_start();

//INCLUINDO O ARQUIVO DE CONFIGURAÇÃO
require_once('../config.php'); //ARQUIVO CONFIG ESTÁ NO DIRETÓRIO ANTERIO

require_once('../conexao.php');

//VERIFICAR PERMISSÃO DO USUÁRIO
require_once('verificar-permissao.php');


$pag = 'usuarios';

//VARIÁVEIS DO MENU ADMINISTRATIVO
$menu1 = 'home';
$menu2 = 'usuarios';
$menu3 = 'fornecedores';
$menu4 = 'categorias';

  //Mastra a versão do php que está rodando
  //phpinfo();

//RECUPERAR DADOS DO USUÁRIO
$query_con = $pdo->query("SELECT * FROM usuarios WHERE id = '$_SESSION[id_usuario]'");

$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC); // ESSE COMANDO É PARA SER USADO SOMENTE NO SELECT

$nome_usu = $res_con[0]['nome'];
$email_usu = $res_con[0]['email'];
$senha_usu = $res_con[0]['senha'];
$nivel_usu = $res_con[0]['nivel'];
$cpf_usu = $res_con[0]['cpf'];
$id_usu = $res_con[0]['id'];

//TESTE
//echo($email_usu);


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
  <link rel="stylesheet" type="text/css" href="../vendor/DataTabels-Traduzido/datatables.min.css"/>
  <script type="text/javascript" src="../vendor/DataTabels-Traduzido/datatables.min.js"></script>
  <!--CDN ICONES BOOTSTRAP-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

  <link rel="shortcut icon" href="../img/favicon.ico"/>
</head>
<body>


	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="../img/logo.png" width="50">
      </a>
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
          <li class="nav-item">
            <a class="nav-link" href="index.php?pagina=<?php echo $menu3 ?>">Fornecedores</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Produtos
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Cadastro de Produtos</a></li>
              <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu4 ?>">Cadastro de Categorias</a></li>
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
                  <?php echo $nome_usu ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-perfil">Editar Perfil</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="../logout.php">Sair</a></li>
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
    else if(@$_GET['pagina'] == $menu3){
      require_once($menu3 .'.php');
    }
    else if(@$_GET['pagina'] == $menu4){
      require_once($menu4 .'.php');
    }
    else{
      require_once($menu1. '.php');
    }

    ?>
  </div>


  <!--TELA MODAL PERFIL USUÁRIOS-->
  <div class="modal fade" tabindex="-1" id="modal-perfil" data-bs-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Perfil</h5>
          <!--TIVE QUE ENGLOBAR O BOTÃO FECHAR NO LINK PARA CORRIGIR O ERRO DE CARREGAMENTO DA PÁGINA-->
          <a href="index.php?pagina=<?php echo $pag ?>"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
        </div>
        <form method="POST" id="form-perfil">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Nome</label>
                  <input type="text" class="form-control" id="input-nome-perfil" name="input-nome-perfil" placeholder="Nome" required="" value="<?php echo @$nome_usu ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">CPF</label>
                  <input type="text" class="form-control" id="input-cpf-perfil" name="input-cpf-perfil" placeholder="CPF" required=""value="<?php echo @$cpf_usu ?>">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">E-mail</label>
              <input type="email" class="form-control" id="input-email-perfil" name="input-email-perfil" placeholder="Email" required="" value="<?php echo @$email_usu ?>">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Senha</label>
              <input type="text" class="form-control" id="input-senha-perfil" name="input-senha-perfil" placeholder="Senha" required="" value="<?php echo @$senha_usu ?>">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Nível</label>
              <!--CRIANDO AS OPÇÕES DE NÍVEL-->
              <select class="form-select mt-1" aria-label="Default select example" name="nivel-perfil">
                <option <?php if(@$nivel_usu == 'Operador'){ ?> selected <?php } ?>  value="Operador">Operador</option>

                <option <?php if(@$nivel_usu == 'Administrador'){ ?> selected <?php } ?>  value="Administrador">Administrador</option>

                <option <?php if(@$nivel_usu == 'Tesoureiro'){ ?> selected <?php } ?>  value="Tesoureiro">Tesoureiro</option>
              </select>
            </div>
            <small>
              <div align="center" class="mt-1" id="mensagem-perfil">

              </div>
            </small>
          </div>
          <div class="modal-footer">
            <!--TIVE QUE ENGLOBAR O BOTÃO FECHAR NO LINK PARA CORRIGIR O ERRO DE CARREGAMENTO DA PÁGINA-->
            <a href="index.php?pagina=<?php echo $pag ?>">
              <button name="btn-fechar-perfil" id="btn-fechar-perfil"type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </a>
            
           
            <button name="btn-salvar-perfil" id="btn-salvar-perfil" type="submit" class="btn btn-primary">Salvar</button>
            

            <!--INPUT DO ID NÃO SERÁ EXIBIDO NA TELA-->
            <input name="id-perfil" type="hidden" value="<?php echo @$id_usu ?>"> 

            <input name="antigoCPF-perfil" type="hidden" value="<?php echo @$cpf_usu ?>"> 

            <input name="antigoEMAIL-perfil" type="hidden" value="<?php echo @$email_usu ?>"> 

          </div>
        </form>
      </div>
    </div>
  </div>


  <!--JAVASCRIPT ARQUIVO MASCARA-->
  <script type="text/javascript" src="../vendor/js/mascaras.js"></script>
  <!--SCRIPT CDN JQUERY E AJAX PARA MASCARA-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

  <!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
  $("#form-perfil").submit(function () {
        var pag = "<?=$pag?>";
        event.preventDefault(); //EVITA QUE A PÁGINA SEJA ATUALIZADA
        var formData = new FormData(this); // CRIANDO A VARIÁVEL DO FORMULARIO

        //ESTRUTURA DO AJAXS
        $.ajax({
          url: "editar-perfil.php",
          type: 'POST',
          data: formData,

          success: function (mensagem) {

            $('#mensagem-perfil').removeClass()

            if (mensagem.trim() == "Salvo com Sucesso!") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar-perfil').click();
                    //window.location = "index.php?pagina="+pag;//FAZ A ATUALIZAÇÃO DA PAGINA

                  } else {
                    //EXIBE A MESAGEM DE ERRO
                    $('#mensagem-perfil').addClass('text-danger')
                  }

                  $('#mensagem-perfil').text(mensagem)

                },

            //PASSAR ARQUIVO JUNTO AO FORMULARIO
            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  // Custom XMLHttpRequest
              var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                  myXhr.upload.addEventListener('progress', function () {
                    /* faz alguma coisa durante o progresso do upload */
                  }, false);
                }
                return myXhr;
              }
            });
      });
    </script>

</body>
</html>