<!--VARIÁVEL DA PÁGINA-->
<?php
 $pag = 'usuarios';
?>

<!--BOTÃO CADASTRAR USUÁRIOS-->
<a href="index.php?pagina=<?php echo $pag ?>&funcao=novo" type="button" class="btn btn-secondary mt-2">Novo Usuário</a>


<!--TELA MODAL CADASTRAR USUÁRIOS-->
<div class="modal fade" tabindex="-1" id="modal-cadastrar" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Inserir Registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nome</label>
            <input type="text" class="form-control" id="input-nome" name="input-nome" placeholder="Nome">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">CPF</label>
            <input type="text" class="form-control" id="input-cpf" name="input-cpf" placeholder="CPF">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">E-mail</label>
            <input type="text" class="form-control" id="input-email" name="input-email" placeholder="Email">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Senha</label>
            <input type="text" class="form-control" id="input-senha" name="input-senha" placeholder="Senha">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nível</label>
            <input type="text" class="form-control" id="input-nivel" name="input-nivel" placeholder="Nível">
          </div>
        </div>
        <div class="modal-footer">
          <button name="btn-fechar" id="btn-fechar"type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button name="btn-salvar" id="btn-salvar" type="button" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!--CHAMADA DA TELA MODAL VIA SCRIPT-->
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

  </script>



<?php } ?>

