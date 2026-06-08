<div class="container">
    <form action="?controller=ContatosController&<?php echo isset($contato->id) ? "method=atualizar&id={$contato->id}" : "method=salvar"; ?>" method="post" onsubmit="return validar()">
        <div class="card" style="top:40px">
            <div class="card-header">
                <span class="card-title">Contatos</span>
            </div>
            <div class="card-body">
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Nome:</label>
                <input type="text" class="form-control col-sm-8" name="nome" id="nome" value="<?php
                echo isset($contato->nome) ? $contato->nome : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Telefone:</label>
                <input type="text" class="form-control col-sm-8" name="telefone" id="telefone" value="<?php
                echo isset($contato->telefone) ? $contato->telefone : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Email:</label>
                <input type="text" class="form-control col-sm-8" name="email" id="email" value="<?php
                echo isset($contato->email) ? $contato->email : null;
                ?>" />
            </div>
            <div class="card-footer">
                <input type="hidden" name="id" id="id" value="<?php echo isset($contato->id) ? $contato->id : null; ?>" />
                <button class="btn btn-success" type="submit">Salvar</button>
                <button class="btn btn-secondary" type="button" onclick="document.querySelectorAll('input:not([type=hidden])').forEach(i => i.value = '')">Limpar</button>
                <a class="btn btn-danger" href="?controller=ContatosController&method=listar">Cancelar</a>
            </div>
        </div>
    </form>
    <script>
        function validar() {
            var nome = document.getElementById('nome').value;
            var email = document.getElementById('email').value;
            var telefone = document.getElementById('telefone').value;
            if (nome === '' || email === '' || telefone === '') {
                alert('Preencha todos os campos obrigatórios!');
                return false;
            }
            return true;
        }
</script>  
</div>
