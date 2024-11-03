create table Paskyros_tipas (
	id int not null,
	name varchar(255) not null,

	primary key (id)
);

create table Vartotojas (
	id int not null,
	prisijungimo_vardas varchar(255) not null,
	slaptazodis varchar(255) not null,
	vardas varchar(255) not null,
	pavarde varchar(255) not null,
	paskyros_tipas_id int not null,

	primary key (id),
	foreign key (paskyros_tipas_id) references Pasyros_tipas(id)
);

create table Straipsnis (
	id int not null,
	pavadinimas varchar(255) not null,
	tema varchar(255) not null,
	tekstas text not null,
	sukurimo_data datetime not null,
	vartotojas_id int not null,

	primary key (id),
	foreign key (vartotojas_id) references Vartotojas(id)
);

create table Vertinimas (
	id int not null,
	vertinimas int not null,
	vartotojas_id int not null,

	primary key (id),
	foreign key (vartotojas_id) references Vartotojas(id)

);
