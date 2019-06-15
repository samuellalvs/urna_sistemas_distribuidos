create database sd_urna;

use sd_urna;

create table candidates(
    id bigint primary key NOT NULL AUTO_INCREMENT,
    name varchar(40),
    number varchar(60),
    photo varchar(40),
    political_party varchar(12)
);

create table votes(
    id bigint primary key NOT NULL AUTO_INCREMENT,
    cpf varchar(20),
    candidate_id bigint,
    foreign key(candidate_id) references candidates(id) on delete cascade
);

insert into candidates(name,number,photo,political_party) values('Fernando Haddad','13','fernando-haddad.jpg','PT');
insert into candidates(name,number,photo,political_party) values('Jair Bolsonaro','17','jair-bolsonaro.jpg','PSL');
insert into candidates(name,number,photo,political_party) values('Geraldo Alckmin','45','geraldo-alckmin.jpg','PSDB');
insert into candidates(name,number,photo,political_party) values('Ciro Gomes','12','ciro-gomes.jpg','PDT');
insert into candidates(name,number,photo,political_party) values('Marina Silva','18','marina-silva.jpg','Rede');
insert into candidates(name,number,photo,political_party) values('Henrique Meirelles','15','henrique-meirelles.jpg','MDB');
insert into candidates(name,number,photo,political_party) values('João Amoêdo','30','joao-amoedo.jpg','Novo');
insert into candidates(name,number,photo,political_party) values('Guilherme Boulos','50','guilherme-boulos.jpg','PSOL');
insert into candidates(name,number,photo,political_party) values('Alvaro Dias','19','alvaro-dias.jpg','Podemos');