create database IT;
use IT;

create table Paskyros_tipas (
	id int not null auto_increment,
	name varchar(255) not null,

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

create table Straipsnis (
	id int not null auto_increment,
	pavadinimas varchar(255) not null,
	tema varchar(255) not null,
	tekstas text not null,
	sukurimo_data datetime not null,
	vartotojas_id int not null,

	primary key (id),
	foreign key (vartotojas_id) references Vartotojas(id)
);

create table Vertinimas (
	id int not null auto_increment,
	vertinimas int not null,
	vartotojas_id int not null,

	primary key (id),
	foreign key (vartotojas_id) references Vartotojas(id)
);

insert into Paskyros_tipas (name) values ("Vartotojas"), ("Vadybininkas");
