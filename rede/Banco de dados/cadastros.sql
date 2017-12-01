create schema cadastros default char set utf8;
use cadastros;

create table cadastro (
	id int not null,
    nome varchar (20) not null,
    sobrenome varchar(20) not null,
	username varchar(10) not null,
	senha varchar(500) not null,
    email varchar (50) not null,
    sexo varchar (2),
	primary key (username)
);
create table amizade(
	convite int not null,
    convidado int not null,
    status varchar(30) not null,
    primary key(convite, convidado),
    foreign key(convite) references cadastro (id),
	foreign key(convidado) references cadastro (id)
);
create table mensagens(
	idRemetente int not null,
    idDestino int not null,
    data date not null,
    mensagem varchar(900) not null,
    primary key(idRemetente,idDestino),
    foreign key (idRemetente) references cadastro (id),
    foreign key (idDestino) references cadastro (id)
);
    
    
    select * from cadastro;
    select * from amizade;
    show tables;
    