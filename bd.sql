CREATE DATABASE crud_contatos;

create table contatos (
id int unsigned auto_increment primary key,
nome varchar(80) not null,
telefone varchar(20) default null,
email varchar(80) default null,
ativo boolean default true
);

create table usuarios (
    id int unsigned auto_increment primary key,
    nome varchar(80) not null,
    email varchar(80) not null,
    senha varchar(255) not null,
    ativo boolean default true,
    data_de_criacao datetime default current_timestamp,
    data_de_atualizacao datetime default current_timestamp on update current_timestamp
);

