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
	vartotojas_id int not null,

	primary key (id),
	foreign key (vartotojas_id) references Vartotojas(id)
);

create table Vartotojas_Tema (
	id int not null auto_increment,
	vartotojas_id int not null,
	tema_id int not null,

	primary key (id),
	foreign key (tema_id) references Tema(id),
	foreign key (vartotojas_id) references Vartotojas(id)
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
	pozicija enum("left", "right", "down", "up") default "down" not null,
	url text not null,

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
	("Reader"),
	("Publisher"),
	("Administrator");

-- dump

-- Vartotojas

INSERT INTO `Vartotojas` (`id`, `prisijungimo_vardas`, `slaptazodis`, `vardas`, `pavarde`, `paskyros_tipas_id`) VALUES
(1, 'rasytojas', '$2y$10$8FbuaePSEtJNQl72EK1uFOlOAiz8Oar.5vnrffgRzx5JEW2h/9wcm', 'Simas', 'Rasytojas', 2),
(2, 'admin', '$2y$10$OQRCYeBplJUfPcgOWqMqk.ffkN.e02GbOsavpskXlcIcR5.9EqF9y', 'Simas', 'Administratorius', 3),
(3, 'skaitytojas', '$2y$10$AZxuDHhJOjtYGoT3a.0JSud3UnoQg2BskH/6Z6LsEpMp5Dcw6FJ0W', 'Simas', 'Skaitytojas', 1);

-- Tema

INSERT INTO `Tema` (`id`, `pavadinimas`, `vartotojas_id`) VALUES
(1, 'Sveikas gyvenimas', 2),
(2, 'Mityba ir maistas', 2),
(3, 'Informacines technologijos', 2),
(4, 'Kompiuteriai ir technika', 2),
(5, 'Mokslas universitete', 2),
(6, 'Juokeliai', 2),
(7, 'Geras miegas', 2);

-- Vartotojas Tema

INSERT INTO `Vartotojas_Tema` (`id`, `vartotojas_id`, `tema_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 3, 1);

-- Straipsnis

INSERT INTO `Straipsnis` (`id`, `pavadinimas`, `sukurimo_data`, `vartotojas_id`, `tema_id`) VALUES
(1, 'Sveikas gyvenimas misko apsuptyje', '2024-11-28 01:04:27', 1, 1),
(2, 'Kodel miegoti yra svarbu?', '2024-12-28 01:47:48', 1, 7);

-- Paveikslelis

INSERT INTO `Paveikslelis` (`id`, `pavadinimas`, `pozicija`, `url`) VALUES
(1, 'Lova', 'left', 'https://www.premierinnbed.co.uk/media/catalog/product/cache/215e62282d4b4b68400b8137e0654108/p/r/premierinn_mattress2.0_lilith_charcoal_gbtb_lifestyle_-_demand_gen_square.jpg'),
(2, 'Lova2', 'right', 'https://www.premierinnbed.co.uk/media/catalog/product/cache/215e62282d4b4b68400b8137e0654108/p/r/premierinn_mattress2.0_lilith_charcoal_gbtb_lifestyle_-_demand_gen_square.jpg');

-- Straipsnis blokas

INSERT INTO `Straipsnis_Blokas` (`id`, `tekstas`, `straipsnis_id`, `paveikslelis_id`) VALUES
(1, 'Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje.', 1, NULL),
(2, 'Labai idomus straipsnis apie gyvenima misko apsuktyje pabaiga.', 1, NULL),
(3, 'Miegoti yra svarbu', 2, 1),
(4, 'Miegoti svarbu', 2, NULL),
(5, 'Miegoti yra labai svarbu', 2, 2);

-- Vertinimas

INSERT INTO `Vertinimas` (`id`, `vertinimas`, `sukurimo_data`, `vartotojas_id`, `straipsnis_id`) VALUES
(1, 8, '2024-11-30 10:15:00', 3, 1),
(2, 9, '2024-11-30 11:20:00', 3, 1),
(3, 7, '2024-11-30 12:30:00', 3, 2);
