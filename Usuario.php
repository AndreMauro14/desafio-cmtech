<?php

class Usuario
{
    private $atributos;

    public function __construct()
    {

    }

    public function __set(string $atributo, $valor)
    {
        $this->atributos[$atributo] = $valor;
        return $this;
    }

    public function __get(string $atributo)
    {
        return $this->atributos[$atributo];
    }

    public function __isset($atributo)
    {
        return isset($this->atributos[$atributo]);
    }

    /**
     * Salva o usuario
     * @return boolean
     */
    public function save()
    {
        $colunas = $this->preparar($this->atributos);
        if (!isset($this->id)) {
            $query = "INSERT INTO usuarios (".
                implode(', ', array_keys($colunas)).
                ") VALUES (".
                implode(', ', array_values($colunas)).");";
        } else {
            foreach ($colunas as $key => $value) {
                if ($key !== 'id') {
                    $definir[] = "{$key}={$value}";
                }
            }
            $query = "UPDATE usuarios SET ".implode(', ', $definir)." WHERE id='{$this->id}';";
        }
        try {
            if ($conexao = Conexao::getInstance()) {
                $stmt = $conexao->prepare($query);
                if ($stmt->execute()) {
                    return $stmt->rowCount();
                }
            }
            return false;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    /**
     * Tornar valores aceitos para sintaxe SQL
     * @param type $dados
     * @return string
     */
    private function escapar($dados)
    {
        if (is_string($dados) & !empty($dados)) {
            return "'".addslashes($dados)."'";
        } elseif (is_bool($dados)) {
            return $dados ? 'TRUE' : 'FALSE';
        } elseif ($dados !== '') {
            return $dados;
        } else {
            return 'NULL';
        }
    }
    /**
     * Verifica se dados são próprios para ser salvos
     * @param array $dados
     * @return array
     */
    private function preparar($dados)
    {
        $resultado = array();
        foreach ($dados as $k => $v) {
            if (is_scalar($v)) {
                $resultado[$k] = $this->escapar($v);
            }
        }
        return $resultado;
    }
    /**
     * Retorna uma lista de usuarios ativos
     * @return array/boolean
     */
    public static function all()
    {
        try {
            $conexao = Conexao::getInstance();
            $stmt    = $conexao->prepare("SELECT * FROM usuarios WHERE ativo=1;");
            $result  = array();
            if ($stmt->execute()) {
                while ($rs = $stmt->fetchObject(Usuario::class)) {
                    $result[] = $rs;
                }
            }
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        if (count($result) > 0) {
            return $result;
        }
        return false;
    }

    /**
     * Retornar o número de registros
     * @return int/boolean
     */
    public static function count()
    {
        try {
            $conexao = Conexao::getInstance();
            $count   = $conexao->exec("SELECT count(*) FROM usuarios;");
            if ($count) {
                return (int) $count;
            }
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        return false;
    }
    /**
     * Encontra um usuario pelo ID (tem que estar ativo)
     * @param type $id
     * @return type
     */
    public static function find($id)
    {
        try {
            $conexao = Conexao::getInstance();
            $stmt    = $conexao->prepare("SELECT * FROM usuarios WHERE id= ? AND ativo=1;");
            if ($stmt->execute([$id])) {
                if ($stmt->rowCount() > 0) {
                    $resultado = $stmt->fetchObject('Usuario');
                    if ($resultado) {
                        return $resultado;
                    }
                }
            }
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        return false;
    }
    /**
     * Altera o usuario para inativo
     * @param type $id
     * @return boolean
     */
    public static function destroy($id)
    {
        try{
            $conexao = Conexao::getInstance();
            $stmt = $conexao->prepare("UPDATE usuarios SET ativo=0 WHERE id= ?;");
            if ($stmt->execute([$id])) {
                return true;
            }
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        
        return false;
    }
}