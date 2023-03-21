    <!--VARIÁVEL DA PÁGINA-->
    <?php
    $pag = 'categorias';

    //INICIANDO A VARIÁVEL DE SESSÃO
    @session_start();

    require_once('../conexao.php');

    //VERIFICAR PERMISSÃO DO USUÁRIO
    require_once('verificar-permissao.php');

    ?>


    <!--BOTÃO CADASTRAR USUÁRIOS-->
    <a href="index.php?pagina=<?php echo $pag ?>&funcao=novo" type="button" id="btn-novoUsuario" class="btn btn-dark mt-2">Nova Categoria</a>

    <!--ADICIONANDO O DATATABLE BOOTSTRAP 5-->
    <div style="margin-right:25px; margin-top: 25px;">

      <?php
        //CONSULTADO REGISTROS NO BD
      $query_con = $pdo->query("SELECT * FROM categorias");

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
                  <th>PRODUTOS</th>
                  <th>FOTO</th>
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
                    <td></td>
                    <td><img src="../img/categorias/<?php echo $res_con[$i]['foto'] ?>" width="50"></td>
                    <td>
                      <!--CONFIGURAÇÕES DO BOTÃO EDITAR-->
                      <a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $res_con[$i]['id'] ?>" title="Editar Registro">
                        <i class="bi bi-pencil-square text-primary"></i>
                      </a>

                      <!--CONFIGURAÇÕES DO BOTÃO DELETAR-->
                      <a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $res_con[$i]['id'] ?>" title="Excluir Registro">
                        <i class="bi bi-trash3-fill text-danger mx-3"></i>
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

          $query = $pdo->query("SELECT * FROM categorias WHERE id = '$_GET[id]' ");

        $res = $query->fetchAll(PDO::FETCH_ASSOC); // ESSE COMANDO É PARA SER USADO SOMENTE NO SELECT

        $total_reg = @count($res);

        //VERIFICANDO SE O E-MAIL JA EXISTE NO BD E PARANDO A INSERSÃO NO BD
        if($total_reg > 0){
          $nome = $res[0]['nome'];
          $foto = $res[0]['foto'];
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
              <div class="modal-body"><!--INICIO BODY FORMULARIO-->

                <!--INICIO DAS CONFIG INPUT NOME-->
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Nome</label>
                  <input type="text" class="form-control" id="input-nome" name="input-nome" placeholder="Nome" required="" value="<?php echo @$nome ?>">
                </div>
                <!--FIM DAS CONFIG INPUT NOME-->

                <!--INICIO DAS CONFIG INPUT FOTO-->
                <div class="form-group">
                  <label >FOTO</label>
                  <input type="file" value="<?php echo @$foto ?>"  class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
                </div>

                <div id="divImgConta" class="mt-4">
                  <?php if(@$foto != ""){ ?>
                    <img src="../img/categorias/<?php echo $foto ?>"  width="100%" id="target">
                  <?php  }else{ ?>
                    <img src="../img/categorias/sem-foto.jpg" width="100%" id="target">
                  <?php } ?>
                </div>
                <!--FIM DAS CONFIG INPUT FOTO-->

                <small>
                  <div align="center" class="mt-1" id="mensagem"></div>
                </small>

              </div><!--FIM BODY FORMULARIO-->

              <div class="modal-footer">
                <!--TIVE QUE ENGLOBAR O BOTÃO FECHAR NO LINK PARA CORRIGIR O ERRO DE CARREGAMENTO DA PÁGINA-->
                <a href="index.php?pagina=<?php echo $pag ?>"><button name="btn-fechar" id="btn-fechar"type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button></a>
                <button name="btn-salvar" id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>

                <!--INPUT DO ID NÃO SERÁ EXIBIDO NA TELA-->
                <input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>"> 

                <input name="antigo" type="hidden" value="<?php echo @$nome ?>"> 

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

          <!-- INICIO SCRIPT PARA CARREGAR IMAGEM -->
          <script type="text/javascript">

            function carregarImg() {

              var target = document.getElementById('target');
              var file = document.querySelector("input[type=file]").files[0];
              var reader = new FileReader();

              reader.onloadend = function () {
                target.src = reader.result;
              };

              if (file) {
                reader.readAsDataURL(file);


              } else {
                target.src = "";
              }
            }

          </script>
          <!-- FIM SCRIPT PARA CARREGAR IMAGEM -->



