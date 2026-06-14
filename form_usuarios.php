<a href="/" class="btn btn-secondary btn-sm">Voltar para Home</a>
<div class="container">
    <form action="?controller=UsuariosController&<?php echo isset($usuario->id) ? "method=atualizar&id={$usuario->id}" : "method=salvar"; ?>" method="post" onsubmit="return validar()">
        <div class="card" style="top:40px">
            <div class="card-header">
                <span class="card-title">Usuarios</span>
            </div>
            <div class="card-body">
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Nome:</label>
                <input type="text" class="form-control col-sm-8" name="nome" id="nome" value="<?php
                echo isset($usuario->nome) ? $usuario->nome : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Email:</label>
                <input type="text" class="form-control col-sm-8" name="email" id="email" value="<?php
                echo isset($usuario->email) ? $usuario->email : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Senha:</label>
                <input type="password" class="form-control col-sm-8" name="senha" id="senha" value=""/>
            </div>
            <div class="card-footer">
                <input type="hidden" name="id" id="id" value="<?php echo isset($usuario->id) ? $usuario->id : null; ?>" />
                <button class="btn btn-success" type="submit">Salvar</button>
                <button class="btn btn-secondary" type="button" onclick="document.querySelectorAll('input:not([type=hidden])').forEach(i => i.value = '')">Limpar</button>
                <a class="btn btn-danger" href="?controller=UsuariosController&method=listar">Cancelar</a>
            </div>
        </div>
    </form>
    <script>
        function validar() {
            var nome = document.getElementById('nome').value;
            var email = document.getElementById('email').value;
            if (nome === '' || email === '') {
                alert('Preencha todos os campos obrigatórios!');
                return false;
            }
            return true;
        }
</script>
</div>