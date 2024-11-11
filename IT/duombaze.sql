drop database if exists IT;
create database IT;
use IT;

create table Paskyros_tipas (
	id int not null auto_increment,
	pavadinimas varchar(255) not null,

	primary key (id)
);

create table Vartotojas (
	id int not null auto_increment,
	prisijungimo_vardas varchar(255) not null,
	slaptazodis varchar(255) not null,
	vardas varchar(255) not null,
	pavarde varchar(255) not null,
	paskyros_tipas_id int not null,

	primary key (id),
	foreign key (paskyros_tipas_id) references Paskyros_tipas(id)
);

create table Tema (
	id int not null auto_increment,
	pavadinimas varchar(255) not null,

	primary key (id)
);

create table Straipsnis (
	id int not null auto_increment,
	pavadinimas varchar(255) not null,
	sukurimo_data datetime not null,
	vartotojas_id int not null,
	tema_id int not null,

	primary key (id),
	foreign key (vartotojas_id) references Vartotojas(id),
	foreign key (tema_id) references Tema(id)
);

create table Paveikslelis (
	id int not null auto_increment,
	pavadinimas varchar(255) not null,
	pozicija enum('kairėje', 'dešinėje', 'apačioje', 'viršuje') default 'apačioje' not null,
	url varchar(1024) not null,

	primary key (id)
);

create table Straipsnis_Blokas (
	id int not null auto_increment,
	tekstas text,
	straipsnis_id int not null,
	paveikslelis_id int,

	primary key (id),
	foreign key (straipsnis_id) references Straipsnis(id),
	foreign key (paveikslelis_id) references Paveikslelis(id)
);

create table Vertinimas (
	id int not null auto_increment,
	vertinimas int not null,
	sukurimo_data datetime not null,
	vartotojas_id int not null,
	straipsnis_id int not null,

	primary key (id),
	foreign key (vartotojas_id) references Vartotojas(id),
	foreign key (straipsnis_id) references Straipsnis(id)
);

insert into Paskyros_tipas (pavadinimas) values
	("Skaitytojas"),
	("Rašytojas"),
	("Administratorius");
