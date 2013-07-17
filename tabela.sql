create table if not exists partida(
  id bigserial primary key,
  event varchar(64) default NULL,
  site varchar(64) default NULL,
  date varchar(16) default NULL,
  round varchar(16) default NULL,
  white varchar(64)default NULL,
  black varchar(64) default NULL,
  result varchar(16) default NULL,
  eco varchar(16) default NULL,
  plycount varchar(16) default NULL,
  eventdate varchar(16) default NULL,
  blackelo character varying(16),
  whiteelo character varying(16),
  notation text
 );
 create table if not exists usuario(
  id bigserial primary key,
  nome varchar(128) default NULL,
  endereco varchar(128) default NULL,
  telefone varchar(16) default NULL,
  sexo varchar(1) default NULL,
  idade varchar(5) default NULL,
  email varchar(128) default NULL,
  usuario varchar(64) default NULL,
  senha varchar(32) default NULL,
  sobre text default NULL,
  permissao varchar(16) default NULL,
  ativo boolean
 );
 insert into usuario(nome,email,usuario,senha,permissao) VALUES('ADMINISTRADOR','admin@admin.com','superadmin',md5('admin000'),'super');

create table if NOT EXISTS  noticias(
  id bigserial primary key,
  titulo varchar(128) default NULL,
  texto text default NULL,
  publicar boolean,
  publica boolean,
  privada boolean,
  autor varchar(64) default NULL
);
CREATE TABLE if not exists  torneio 
(
  id bigserial NOT NULL,
  nome character varying(64) DEFAULT NULL::character varying,
  descricao text,
  publicar boolean,
  tipo character varying(16) DEFAULT NULL::character varying,
  autor character varying(32) DEFAULT NULL::character varying,
  encerramento_inscricao character varying(16),
  CONSTRAINT torneio_pkey PRIMARY KEY (id)
);

CREATE TABLE if not exists cadastro_torneio
(
  id bigserial NOT NULL,
  id_torneio bigserial NOT NULL,
  id_user bigint NOT NULL,
  CONSTRAINT cadastro_torneio_pkey PRIMARY KEY (id),
  CONSTRAINT torneio_pkey FOREIGN KEY (id_torneio)
      REFERENCES torneio (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT user_pkey FOREIGN KEY (id_user)
      REFERENCES usuario (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

 CREATE TABLE IF NOT EXISTS  ci_sessions (
	session_id varchar(40) DEFAULT '0' NOT NULL,
	ip_address varchar(45) DEFAULT '0' NOT NULL,
	user_agent varchar(120) NOT NULL,
	last_activity bigserial,
	user_data text NOT NULL,
	PRIMARY KEY (session_id)
);