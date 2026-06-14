# Desafio Técnico CMTECH

Este repositório contém a solução do desafio técnico da CMTECH para a vaga de estágio. O projeto é um sistema de CRUD onde é possível gerenciar contatos e usuários.

## Tecnologias Utilizadas

- PHP 8.4
- MySQL
- HTML
- CSS (Bootstrap)
- JavaScript

## Pré-requisitos

- PHP instalado na máquina
- MySQL instalado

> Obs: no Linux Debian, o MySQL foi substituído pelo MariaDB, que é 100% compatível — mesma sintaxe SQL, mesmo driver PDO no PHP. Os comandos abaixo funcionam da mesma forma em ambos.

### Instalação no Debian/Ubuntu

```bash
sudo apt update
sudo apt install php php-mysql php-pdo mariadb-server
```

## Como Rodar o Projeto

1. Clone o repositório:

```bash
git clone https://github.com/AndreMauro14/desafio-cmtech.git
cd desafio-cmtech
```

2. Configure o banco de dados:

```bash
sudo mysql -u root
```

Dentro do MySQL, execute:

```sql
ALTER USER 'root'@'localhost' IDENTIFIED BY '';
FLUSH PRIVILEGES;
CREATE DATABASE crud_contatos;
USE crud_contatos;
SOURCE bd.sql;
EXIT;
```

> Obs: o comando SOURCE bd.sql funciona quando você abre o MySQL no mesmo diretório do projeto. Caso contrário, use o caminho completo: SOURCE /caminho/do/projeto/bd.sql;

3. Suba o servidor:

```bash
php -S localhost:8000
```

4. Acesse no navegador: http://localhost:8000

## O que Foi Implementado

- Entidade Usuário no banco de dados (NOME, EMAIL, SENHA, ATIVO, DATA DE CRIAÇÃO, DATA DE ATUALIZAÇÃO)
- CRUD completo de Usuários seguindo o padrão MVC identificado no repositório
- Exclusão lógica nos CRUDs de Contatos e Usuários
- Tratamento de exceções com try/catch nos Models e na Conexão
- Criptografia de senha com password_hash do PHP
- Validação de campos obrigatórios com JavaScript
- Confirmação antes de excluir com JavaScript
- Link de navegação para Usuários na página inicial
- Prepared statements para prevenção de SQL injection nos métodos find() e destroy()