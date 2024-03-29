<!--VARIÁVEL DA PÁGINA-->
<?php
$pag = 'fornecedores';

//INICIANDO A VARIÁVEL DE SESSÃO
@session_start();

require_once('../conexao.php');

//VERIFICAR PERMISSÃO DO USUÁRIO
require_once('verificar-permissao.php');

?>


<!--BOTÃO CADASTRAR USUÁRIOS-->
<a href="index.php?pagina=<?php echo $pag ?>&funcao=novo" type="button" id="btn-novoUsuario" class="btn btn-dark mt-2">Novo Fornecedor</a>

<!--ADICIONANDO O DATATABLE BOOTSTRAP 5-->
<div style="margin-right:25px; margin-top: 25px;">

  <?php
    //CONSULTADO REGISTROS NO BD
  $query_con = $pdo->query("SELECT * FROM fornecedores");

    $res_con = $query_con->fetchAll(PDO::FETCH_ASSOC); // ESSE COMANDO É PARA SER USADO SOMENTE NO SELECT

    $total_reg = @count($res_con);

    //VERIFICANDO SE O E-MAIL JA EXISTE NO BD E PARANDO A INSERSÃO NO BD
    if($total_reg > 0){
      ?>
      <small>
        <table id="example" class="table table-dark table-striped table-responsive" style="width:100%; padding-top: 15px; margin-bottom: 10px;">
          <thead>
            <tr>
              <th>NOME</th>
              <th>TIPO PESSOA</th>
              <th>DOCUMENTO</th>
              <th>TELEFONE</th>
              <th>EMAIL</th>
              
              <th>AÇÕES</th>
            </tr>
          </thead>
          <tbody>
            <!--ABRINDO O FOR DENTRO DO PHP-->
            <?php
              //FOR PARA PERCORRER OS DADOS DO BANCO DE DADOS
            for($i=0; $i < $total_reg; $i++){
              foreach ($res_con[$i] as $key => $value){

              }
              ?>
              <tr>
                <!--RECUPERANDO OS DADOS DO BD-->
                <td><?php echo $res_con[$i]['nome'] ?></td>
                <td><?php echo $res_con[$i]['tipoPessoa'] ?></td>
                <td><?php echo $res_con[$i]['doc'] ?></td>
                <td><?php echo $res_con[$i]['telefone'] ?></td>
                <td><?php echo $res_con[$i]['email'] ?></td>
                
                <td>
                  <!--CONFIGURAÇÕES DO BOTÃO EDITAR-->
                  <a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $res_con[$i]['id'] ?>" title="Editar Registro">
                    <i class="bi bi-pencil-square text-primary"></i>
                  </a>

                  <!--CONFIGURAÇÕES DO BOTÃO DELETAR-->
                  <a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $res_con[$i]['id'] ?>" title="Excluir Registro">
                    <i class="bi bi-trash3-fill text-danger mx-3"></i>
                  </a>

                  <!--CONFIGURAÇÕES DO BOTÃO VISUALIZAR ENDEREÇO-->
                  <a href="#" onclick="mostrarDados('<?php echo $res_con[$i]['endereco'] ?>', '<?php echo $res_con[$i]['nome'] ?>')" title="Ver Endereço">
                    <i class="bi bi-house text-success"></i>
                  </a>
                </td>
              </tr>
              <?php } ?> <!--FECHANDO O FOR DENTRO DO PHP-->
            </tbody>
          </table>
        </small>
      </div>
    <?php } else{
      echo "<p>Não existem dados para serem exibidos.</p>";
    }?>  

    <!--CRIANDO A VARIÁVEL DA TELA MODAL CADASTRAR USUÁRIOS-->
    <?php 
    if(@$_GET['funcao'] == "editar") { 
      $titulo_modal = 'Editar Registro';

      $query = $pdo->query("SELECT * FROM fornecedores WHERE id = '$_GET[id]' ");

    $res = $query->fetchAll(PDO::FETCH_ASSOC); // ESSE COMANDO É PARA SER USADO SOMENTE NO SELECT

    $total_reg = @count($res);

    //VERIFICANDO SE O E-MAIL JA EXISTE NO BD E PARANDO A INSERSÃO NO BD
    if($total_reg > 0){
      $nome         = $res[0]['nome'];
      $tipoPessoa   = $res[0]['tipoPessoa'];
      $doc          = $res[0]['doc'];
      $email        = $res[0]['email'];
      $telefone     = $res[0]['telefone'];
      $endereço     = $res[0]['endereco'];
    }

  }else if (@$_GET['funcao'] == "novo"){
    $titulo_modal = 'Inserir Registro';
  } else {
    $titulo_modal = 'Excluir Registro';
  }

  ?>

  <!--TELA MODAL CADASTRAR USUÁRIOS-->
  <div class="modal fade" tabindex="-1" id="modal-cadastrar" data-bs-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?php echo $titulo_modal ?></h5>
          <!--TIVE QUE ENGLOBAR O BOTÃO FECHAR NO LINK PARA CORRIGIR O ERRO DE CARREGAMENTO DA PÁGINA-->
          <a href="index.php?pagina=<?php echo $pag ?>"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
        </div>
        <form method="POST" id="form">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Nome</label>
                  <input type="text" class="form-control" id="input-nome" name="input-nome" placeholder="Nome" required="" value="<?php echo @$nome ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Tipo Pessoa</label>
                  <select class="form-select mt-1" aria-label="Default select example" name="select-tipoPessoa">

                    <option <?php if(@$tipoPessoa == 'Física'){ ?> selected <?php } ?>  value="Física">Física</option>

                    <option <?php if(@$tipoPessoa == 'Jurídica'){ ?> selected <?php } ?>  value="Jurídica">Jurídica</option>

                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Documento</label>
                  <input type="text" class="form-control" id="input-doc" name="input-doc" placeholder="CPF / CNPJ" required="" value="<?php echo @$doc?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Telefone</label>
                  <input type="text" class="form-control" id="input-telefone" name="input-telefone" placeholder="(XX) XXXXX-XXXX" value="<?php echo @$telefone ?>">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">E-mail</label>
              <input type="email" class="form-control" id="input-email" name="input-email" placeholder="Endereço eletrônico" value="<?php echo @$email ?>">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Endereço</label>
              <input type="text" class="form-control" id="input-endereco" name="input-endereco" placeholder="Rua X, Número XX , Bairro XXX, Cidade/Estado" value="<?php echo @$endereco ?>">
            </div>
            <small>
              <div align="center" class="mt-1" id="mensagem">

              </div>
            </small>
          </div>
          <div class="modal-footer">
            <!--TIVE QUE ENGLOBAR O BOTÃO FECHAR NO LINK PARA CORRIGIR O ERRO DE CARREGAMENTO DA PÁGINA-->
            <a href="index.php?pagina=<?php echo $pag ?>"><button name="btn-fechar" id="btn-fechar"type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button></a>
            <button name="btn-salvar" id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>

            <!--INPUT DO ID NÃO SERÁ EXIBIDO NA TELA-->
            <input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>"> 

            <input name="antigoDOC" type="hidden" value="<?php echo @$doc ?>"> 

            <input name="antigoEMAIL" type="hidden" value="<?php echo @$email ?>"> 

          </div>
        </form>
      </div>
    </div>
  </div>


  <!--TELA MODAL DELETAR-->
  <div class="modal fade" tabindex="-1" id="modal-deletar">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?php echo $titulo_modal ?></h5>
          <!--TIVE QUE ENGLOBAR O BOTÃO FECHAR NO LINK PARA CORRIGIR O ERRO DE CARREGAMENTO DA PÁGINA-->
          <a href="index.php?pagina=<?php echo $pag ?>"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
        </div>
        <form method="POST" id="form-excluir">
          <div class="modal-body">

            <p>Deseja Realmente Exluir o Registro?</p>

            <small>
              <div align="center" class="mt-1" id="mensagem-excluir">

              </div>
            </small>

          </div>
          <div class="modal-footer">
            <!--TIVE QUE ENGLOBAR O BOTÃO FECHAR NO LINK PARA CORRIGIR O ERRO DE CARREGAMENTO DA PÁGINA-->
            <a href="index.php?pagina=<?php echo $pag ?>"><button name="btn-fechar" id="btn-fechar"type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button></a>
            <button name="btn-excluir" id="btn-excluir" type="submit" class="btn btn-danger">Excluir</button>

            <!--INPUT DO ID NÃO SERÁ EXIBIDO NA TELA-->
            <input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>"> 

          </div>
        </form>
      </div>
    </div>
  </div>

  <!--TELA MODAL MOSTRAR ENDEREÇO-->
  <div class="modal fade" tabindex="-1" id="modal-dados">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Endereço Fornecedor</h5>
          <!--TIVE QUE ENGLOBAR O BOTÃO FECHAR NO LINK PARA CORRIGIR O ERRO DE CARREGAMENTO DA PÁGINA-->
          <a href="index.php?pagina=<?php echo $pag ?>"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
        </div>
        <div class="modal-body mb-4">

          <b>Nome: </b>
          <span id="nome-registro"></span>
          <hr>

          <b>Endereço: </b>
          <span id="endereco-registro"></span>

        </div>
      </div>
    </div>
  </div>


  <!--CHAMADA DA TELA MODAL NOVO USUÁRIO VIA SCRIPT-->
  <?php if(@$_GET['funcao'] == "novo") { ?>

    <script type="text/javascript">

    //CRIANDO A VARIÁVEL DA TELA MODAL - NÃO ESTATICA
    //var myModal = new bootstrap.Modal(document.getElementById('modal-cadastrar'));
    //const myModal = new bootstrap.Modal(document.getElementById('modal-cadastrar'))



    //CRIANDO A VARIÁVEL DA TELA MODAL - ESTATICA
    const myModal = new bootstrap.Modal(document.getElementById('modal-cadastrar'), {
      backdrop: 'static'

    });

    //ABRIR A TELA MODAL ( myModal.show(); or myModal.toggle(); )
    myModal.show();
    //myModal.toggle();

  </script>

<?php } ?>

<!--CHAMADA DA TELA MODAL EDITAR VIA SCRIPT-->
<?php if(@$_GET['funcao'] == "editar") { ?>

  <script type="text/javascript">

    //CRIANDO A VARIÁVEL DA TELA MODAL - NÃO ESTATICA
    //var myModal = new bootstrap.Modal(document.getElementById('modal-cadastrar'));
    //const myModal = new bootstrap.Modal(document.getElementById('modal-cadastrar'))



    //CRIANDO A VARIÁVEL DA TELA MODAL - ESTATICA
    const myModal = new bootstrap.Modal(document.getElementById('modal-cadastrar'), {
      backdrop: 'static'

    });

    //ABRIR A TELA MODAL ( myModal.show(); or myModal.toggle(); )
    myModal.show();
    //myModal.toggle();

  </script>

<?php } ?>

<!--CHAMADA DA TELA MODAL DELETAR VIA SCRIPT-->
<?php if(@$_GET['funcao'] == "deletar") { ?>

  <script type="text/javascript">

    //CRIANDO A VARIÁVEL DA TELA MODAL - ESTATICA
    const myModal = new bootstrap.Modal(document.getElementById('modal-deletar'), {
      //backdrop: 'static'
    });

    myModal.show();


  </script>

<?php } ?>


<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
  $("#form").submit(function () {
    var pag = "<?=$pag?>";
        event.preventDefault(); //EVITA QUE A PÁGINA SEJA ATUALIZADA
        var formData = new FormData(this); // CRIANDO A VARIÁVEL DO FORMULARIO

        //ESTRUTURA DO AJAXS
        $.ajax({
          url: pag + "/inserir.php",
          type: 'POST',
          data: formData,

          success: function (mensagem) {

            $('#mensagem').removeClass()

            if (mensagem.trim() == "Salvo com Sucesso!") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    window.location = "index.php?pagina=<?php echo $pag ?>";//FAZ A ATUALIZAÇÃO DA PAGINA

                  } else {
                    //EXIBE A MESAGEM DE ERRO
                    $('#mensagem').addClass('text-danger')
                  }

                  $('#mensagem').text(mensagem)

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

    <!--AJAX PARA EXCLUIR DADOS-->
    <script type="text/javascript">
      $("#form-excluir").submit(function () {
        var pag = "<?=$pag?>";
        event.preventDefault(); //EVITA QUE A PÁGINA SEJA ATUALIZADA
        var formData = new FormData(this); // CRIANDO A VARIÁVEL DO FORMULARIO

        //ESTRUTURA DO AJAXS
        $.ajax({
          url: pag + "/excluir.php",
          type: 'POST',
          data: formData,

          success: function (mensagem) {

            $('#mensagem').removeClass()

            if (mensagem.trim() == "Excluído com Sucesso!") {

              $('#mensagem-excluir').addClass('text-success')

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    window.location = "index.php?pagina=<?php echo $pag ?>";//FAZ A ATUALIZAÇÃO DA PAGINA

                  } else {
                    //EXIBE A MESAGEM DE ERRO
                    $('#mensagem-excluir').addClass('text-danger')
                  }

                  $('#mensagem-excluir').text(mensagem)

                },

                cache: false,
                contentType: false,
                processData: false,

              });
      });
    </script>

    <!--SCRITP JQUERY DATATABLES BOOTSTRAP 5-->
    <script type="text/javascript">
      $(document).ready(function () {
        $('#example').DataTable();
      });
    </script>

    <!--SCRITP FUNÇÃO MOSTRAR DADOS-->
    <script type="text/javascript">

      function mostrarDados(endereco, nome){
        
        event.preventDefault(); //EVITA QUE A PÁGINA SEJA ATUALIZADA

        //ASSOCIANDO AS VARIÁVEIS AOS CAMPOS DA MODAL DADOS
        $('#nome-registro').text(nome);
        $('#endereco-registro').text(endereco);

        //CRIANDO A VARIÁVEL DA TELA MODAL - ESTATICA
        const myModal = new bootstrap.Modal(document.getElementById('modal-dados'), {
          backdrop: 'static'

        });

        //ABRIR A TELA MODAL ( myModal.show(); or myModal.toggle(); )
        myModal.show();
        //myModal.toggle();
  }

    </script>


