<?php

class UsuariosController extends Controller
{

    /**
     * Lista os usuários
     */
    public function listar()
    {
        $usuarios = Usuario::all();
        return $this->view('grade_usuarios', ['usuarios' => $usuarios]);
    }

    /**
     * Mostrar formulario para criar um novo usuário
     */
    public function criar()
    {
        return $this->view('form_usuarios');
    }

    /**
     * Mostrar formulário para editar um usuário
     */
    public function editar($dados)
    {
        $id      = (int) $dados['id'];
        $usuario = Usuario::find($id);

        return $this->view('form_usuarios', ['usuario' => $usuario]);
    }

    /**
     * Salvar o usuário submetido pelo formulário
     */
    public function salvar()
    {
        $usuario           = new Usuario;
        $usuario->nome     = $this->request->nome;
        $usuario->senha    = password_hash($this->request->senha, PASSWORD_DEFAULT);
        $usuario->email    = $this->request->email;
        if ($usuario->save()) {
            return $this->listar();
        }
    }

    /**
     * Atualizar o usuário conforme dados submetidos
     */
    public function atualizar($dados)
    {
        $id                = (int) $dados['id'];
        $usuario           = Usuario::find($id);
        $usuario->nome     = $this->request->nome;
        if (!empty($this->request->senha)) {
            $usuario->senha    = password_hash($this->request->senha, PASSWORD_DEFAULT);
        }
        $usuario->email    = $this->request->email;
        $usuario->save();

        return $this->listar();
    }

    /**
     * Apagar um usuário conforme o id informado
     */
    public function excluir($dados)
    {
        $id      = (int) $dados['id'];
        $usuario = Usuario::destroy($id);
        return $this->listar();
    }
}