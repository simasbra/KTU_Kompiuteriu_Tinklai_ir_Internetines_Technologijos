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
	pozicija enum("left", "right", "bottom", "top") default "bottom" not null,
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
(7, 'Geras miegas', 2),
(8, 'Knygos', 2);

-- Vartotojas Tema

INSERT INTO `Vartotojas_Tema` (`id`, `vartotojas_id`, `tema_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(6, 3, 1),
(7, 3, 2),
(8, 4, 1),
(9, 4, 2),
(10, 4, 7),
(11, 4, 8);

-- Straipsnis

INSERT INTO `Straipsnis` (`id`, `pavadinimas`, `sukurimo_data`, `vartotojas_id`, `tema_id`) VALUES
(1, 'Sveikas gyvenimas misko apsuptyje', '2024-11-28 01:04:27', 1, 1),
(2, 'Kodel miegoti yra svarbu?', '2024-12-28 01:47:48', 1, 7),
(3, 'Koki kompiuteri yra geriausia pirkti?', '2024-12-01 11:33:34', 1, 4),
(4, 'Galingiausias kompiuteris pasaulyje', '2024-12-01 11:59:33', 1, 4),
(5, 'SkanÅ«s miltiniai blynai', '2024-12-01 12:02:16', 1, 2),
(6, 'GOOD SLEEP CAPS, 30 kapsuliÅ³', '2024-12-01 12:14:46', 1, 7),
(7, 'Voldenas, arba gyvenimas miÅ¡ke', '2024-12-01 12:20:09', 1, 8),
(8, 'Motyvacija: kaip motyvuoti save?', '2024-12-01 12:26:02', 1, 1),
(9, 'Kas yra sveika mityba ir sveikas gyvenimo bÅ«das?', '2024-12-01 12:29:06', 1, 1);

-- Paveikslelis

INSERT INTO `Paveikslelis` (`id`, `pavadinimas`, `pozicija`, `url`) VALUES
(1, 'Lova', 'left', 'https://www.premierinnbed.co.uk/media/catalog/product/cache/215e62282d4b4b68400b8137e0654108/p/r/premierinn_mattress2.0_lilith_charcoal_gbtb_lifestyle_-_demand_gen_square.jpg'),
(2, 'Lova2', 'right', 'https://www.premierinnbed.co.uk/media/catalog/product/cache/215e62282d4b4b68400b8137e0654108/p/r/premierinn_mattress2.0_lilith_charcoal_gbtb_lifestyle_-_demand_gen_square.jpg'),
(3, 'Senas kompiuteris', 'left', 'https://www.startpage.com/av/proxy-image?piurl=http%3A%2F%2Fwww.vintageisthenewold.com%2Fwp-content%2Fuploads%2F2017%2F08%2Fimbpc.jpg&sp=1733045479Tba613dc2d27484b1fa9d9a26b892d5bcd4678e0cfbed2c61fa38d2469eb6124d'),
(4, 'El Capitan', 'top', 'https://www.startpage.com/av/proxy-image?piurl=https%3A%2F%2Fentechonline.com%2Fwp-content%2Fuploads%2F2024%2F11%2Fworlds-fastest-supercomputer-870x468.jpg&sp=1733046754Tbd63c1763126feb99cbf6167679270cd905038ef9a4f346c718e1114b46a0269'),
(5, 'Blynai', 'top', 'https://www.lamaistas.lt/uploads/modules/recipes/thumb920x573/44676.jpg'),
(6, 'Blynai', 'left', 'https://www.lamaistas.lt/uploads/modules/recipes/thumb920x573/44677.jpg'),
(7, 'GOOD SLEEP CAPS, 30 kapsuliÅ³', 'right', 'https://www.eurovaistine.lt/media/cache/ev_popup/f0/ac/51dce85a8ac7f6d16b263f829a7f.jpg'),
(8, 'Voldenas, arba gyvenimas miÅ¡ke', 'top', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/25/Walden_Thoreau.jpg/400px-Walden_Thoreau.jpg'),
(9, 'Voldeno tvenkinys', 'left', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/84/2012-06-27-Walden-Pond-03_73.jpg/460px-2012-06-27-Walden-Pond-03_73.jpg'),
(10, 'Motyvacija', 'top', 'https://lengvosmintys.lt/wp-content/uploads/2024/05/motyvacija.webp'),
(11, 'Mergina skaito knyga', 'top', 'https://lengvosmintys.lt/wp-content/uploads/2024/05/motyvacija2.webp'),
(12, 'Nuotrauka: pexels.com/Ella Olsson', 'right', 'https://ksd-images.lt/display/senukai_lt/uploads/ca/f460905e/4ed6928b.jpg');

-- Straipsnis blokas

INSERT INTO `Straipsnis_Blokas` (`id`, `tekstas`, `straipsnis_id`, `paveikslelis_id`) VALUES
(1, 'Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje.', 1, NULL),
(2, 'Labai idomus straipsnis apie gyvenima misko apsuktyje pabaiga.', 1, NULL),
(3, 'Miegoti yra svarbu', 2, 1),
(4, 'Miegoti svarbu', 2, NULL),
(5, 'Miegoti yra labai svarbu', 2, 2),
(6, 'Kompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?', 3, 3),
(7, 'As of November 2024, the number one supercomputer is El Capitan, the leader on Green500 is JEDI, a Bull Sequana XH3000 system using the Nvidia Grace Hopper GH200 Superchip. In June 2022, the top 4 systems of Graph500 used both AMD CPUs and AMD accelerators. After an upgrade, for the 56th TOP500 in November 2020,', 4, 4),
(8, 'El Capitan uses a combined 11,039,616 CPU and GPU cores consisting of 43,808 AMD 4th Gen EPYC 24C \"Genoa\" 24 core 1.8 GHz CPUs (1,051,392 cores) and 43,808 AMD Instinct MI300A GPUs (9,988,224 cores). The MI300A consists of 24 Zen4 based CPU cores, and a CDNA3 based GPU integrated onto a single organic package, along with 128GB of HBM3 memory.', 4, NULL),
(9, 'Labai gardÅ«s miltiniai blyneliai. Tokius kepdavo mano moÄiutÄ—. Pagal Å¡Ä¯ receptÄ… pagaminti jie pavyksta gana ploni, minkÅ¡tuÄiai ir tiesiog sutirpsta burnoje. Jeigu mÄ—gstate puresnius, storesnius blynelius, galite vietoje pieno pilti kefyrÄ…, Ä¯dÄ—ti Å¡iek tiek kepimo milteliÅ³ bei daryti truputÄ¯ tirÅ¡tesnÄ™ teÅ¡lÄ…. Bet prieÅ¡ eksperimentus bÅ«tinai paragaukite blyneliÅ³, iÅ¡keptÅ³ pagal originalÅ³ receptÄ…, nes jie tikrai labai geri ir mane paÄiÄ…, daÅ¾niausiai puriÅ³ blynÅ³ mylÄ—tojÄ…, kaskart nustebina, kokie jie skanÅ«s. O tarp vaikÅ³ Å¡ie blynukai turi iÅ¡vis neÄ¯tikÄ—tina pasisekimÄ…. Beje, cukraus kiekÄ¯ galite koreguoti savo nuoÅ¾iÅ«ra. Jeigu valgysite su saldesne uogiene, tikrai pakaks ir 1 Å¡aukÅ¡to ar maÅ¾iau. IÅ¡ recepte nurodyto kiekio mums paprastai iÅ¡kepu 18-20 blyneliÅ³, kuriÅ³ uÅ¾tenka 2 alkaniems arba 3 maÅ¾iau alkaniems valgytojams.', 5, 5),
(10, 'SKANIÅ² MILTINIÅ² BLYNÅ² PARUOÅ IMO BÅªDAS:\r\nParuoÅ¡imo laikas: Apie 30 min.\r\n1.\r\nKiauÅ¡inius Ä¯muÅ¡ti Ä¯ indÄ…, berti cukrÅ³, Å¾iupsnelÄ¯ druskos ir gerai. iÅ¡plakti.\r\n2.\r\nSuberti miltus ir Å¡aukÅ¡tu gerai iÅ¡maiÅ¡yti. Per kelis kartus supilti pienÄ…, kaskart gerai iÅ¡maiÅ¡ant. TurÄ—tÅ³ gautis poskystÄ— teÅ¡la. JÄ… palikti 10-15 min pastovÄ—ti, kad miltai iÅ¡brinktÅ³.\r\n3.\r\nKeptuvÄ—je Ä¯kaitinti truputÄ¯ aliejaus arba sviesto. Vienam blyneliui dÄ—ti po daugmaÅ¾ Å¡aukÅ¡tÄ… teÅ¡los. Kepti ant vidutinÄ—s kaitros. Kai blyneliÅ³ virÅ¡us pakeisk spalvÄ… ir atsiras burbuliukÅ³, apversti ir dar Å¡iek tiek pakepti.\r\n4.\r\nTiekti iÅ¡ karto iÅ¡keptus, paÅ¡ildytose lÄ—kÅ¡tÄ—se arba laikyti Å¡iltoje orkaitÄ—je, kad neatvÄ—stÅ³.\r\n5.\r\nÅ iuos blynelius tinka valgyti su uogiene, grietine, jogurtu ar kaip tik mÄ—gstate.', 5, NULL),
(11, 'Patarimai:\r\nâ€¢\r\nBlyneliÅ³ forma. Kepant apvertus blyneliai Å¡iek tiek iÅ¡siries, tarsi dubenÄ—liai - viskas tvarkoje, taip ir turi bÅ«ti. SudÄ—jus Ä¯ lÄ—kÅ¡tÄ™ jie suplokÅ¡tÄ—s.\r\nâ€¢\r\nStorumas. Å ie blyneliai yra ploni, minkÅ¡tuÄiai ir tiesiog sutirpsta burnoje. Jeigu mÄ—gstate puresnius, storesnius blynelius, galite vietoje pieno pilti kefyrÄ…, Ä¯dÄ—ti Å¡iek tiek kepimo milteliÅ³ bei daryti truputÄ¯ tirÅ¡tesnÄ™ teÅ¡lÄ… dÄ—dami daugiau miltÅ³.\r\nâ€¢\r\nSaldumas. Cukraus kiekÄ¯ galite koreguoti savo nuoÅ¾iÅ«ra. Jei valgysite su saldesne uogiene, cukraus pakaks ir 1 Å¡aukÅ¡to.', 5, 6),
(12, 'Tinka alergiÅ¡kiems: Ne\r\nTinka diabetikams: Ne\r\nEkologiÅ¡kas : Ne\r\nNatÅ«ralus: Taip\r\nAmÅ¾iaus grupÄ—: Suaugusiems\r\nAmÅ¾ius: Nuo 18 metÅ³\r\nPagrindiniai ingredientai: Melatoninas, PasiflorÅ³ ekstraktas\r\nPaskirtis: NervÅ³ sistemai, Miegui\r\nPrekiÅ³ forma: KapsulÄ—s\r\nProdukto iÅ¡skirtinumas: Su augaliniais ekstraktais\r\nSkonis: Neutralus\r\nTinka nÄ—Å¡tumo ir Å¾indymo metu: Netinka nÄ—Å¡tumo ir Å¾indymo metu', 6, NULL),
(13, 'Normaliai nervÅ³ sistemos bÅ«klei ir normaliai miego kokybei.\r\n\r\nâ€žGood Sleep Capsâ€œ  sudÄ—tyje yra melatonino, kuris padeda maÅ¾inti subjektyvÅ³ laiko juostÅ³ skirtumo pajautimÄ…Â¹, taip pat padeda maÅ¾inti laiko, reikalingo norint uÅ¾migti, trukmÄ™Â².\r\n\r\nRaudonÅ¾iedÄ—s pasifloros Å¾olÄ—s ekstraktas ir apyniai padeda palaikyti normaliÄ… nervÅ³ sistemos funkcijÄ…. Vaistiniai valerijonai padeda palaikyti normaliÄ… nervÅ³ sistemos bÅ«klÄ™ ir miego kokybÄ™.', 6, 7),
(14, 'Â¹Teigiamas poveikis pasireiÅ¡kia suvartojant ne maÅ¾iau kaip 0,5 mg melatonino prieÅ¡ einant miegoti pirmÄ… kelionÄ—s dienÄ… ir kelias dienos po atvykimo Ä¯ kelionÄ—s tikslo vietÄ….\r\n\r\nÂ²Teigiamas poveikis pasireiÅ¡kia suvartojant  1 mg melatonino prieÅ¡ einant miegoti.\r\n\r\nGrynasis kiekis: 17,6 g\r\n\r\nGamintojas: Ltd â€œLotos Pharmaâ€, Pernavas 1-39, Riga, LV-1012, Latvia.\r\n\r\nAtstovas Lietuvoje: UAB â€žLotos pharmaâ€œ, SavanoriÅ³ pr. 178A, LT-03154, Vilnius.\r\n\r\nKilmÄ—: Europos SÄ…junga.', 6, NULL),
(15, 'Voldenas, arba gyvenimas miÅ¡ke (angl. Walden; or, Life in the Woods) â€“ amerikieÄiÅ³ transcendentalisto filosofo Henrio Deivido Toro Å¾ymiausias veikalas. Tai 1854 m. iÅ¡leisti memuarai apie tai, kaip Toro praleido dvejus metus, dvi savaites ir dvi dienas paties pasistatytoje trobelÄ—je miÅ¡kuose prie Vodeno tvenkinio, netoli gimtojo Konkordo (MasaÄiusetsas).', 7, 8),
(16, 'Knygoje autorius pasakoja apie prieÅ¾astis, paskatinusias jÄ¯ ryÅ¾tis tokiam iÅ¡bandymui â€“ jis norÄ—jÄ™s patirti tikrÄ… gyvenimÄ…, suvokti gyvenimo esmÄ™, atsisakyti visÅ³ nereikalingÅ³ daiktÅ³ ir santykiÅ³. TaÄiau Toro pabrÄ—Å¾ia, kad jis nesiekiÄ…s gyventi atsiskyrÄ—liÅ¡kai, bet atsidÄ—ti skaitymui, apmÄ…stymams. IÅ¡Ä—jau Ä¯ miÅ¡kÄ… todÄ—l, kad norÄ—jau gyventi iÅ¡mintingai, turÄ—ti reikalÄ… tik su esmingais gyvenimo faktais ir Ä¯sitikinti, kad jis mane gali kaÅ¾ko iÅ¡mokyti, ir kad prieÅ¡ pat mirtÄ¯ nepasirodytÅ³, jog iÅ¡vis negyvenau.', 7, 9),
(17, 'â€žVoldeneâ€œ autorius nuodugniai apraÅ¡o, kaip ir kur pasistatÄ— savo bÅ«stÄ…, kaip pragyveno, pateikia visas savo pajamas ir iÅ¡laidas. Daug dÄ—mesio skiriama gamtos stebÄ—jimams ir apraÅ¡ymams â€“ Vodeno ir aplinkiniÅ³ tvenkiniÅ³, miÅ¡ko augalijos ir gyvÅ«nijos, orÅ³, metÅ³ laikÅ³. Toro taip pat apraÅ¡o kai kuriuos per tuos dvejus metus sutiktus Å¾mones, pateikia jÅ³ pasakojimus, vietos tenka ir kitame tvenkinio krante buvusio geleÅ¾inkelio apraÅ¡ymui.', 7, NULL),
(18, 'Paprastai tariant, motyvacija â€“ tai vidinÄ— jÄ—ga, skatinanti veikti ir siekti savo tikslÅ³. Tai tarsi variklis, varantis mus Ä¯ priekÄ¯, padedantis Ä¯veikti uÅ¾duotis ir iÅ¡laikyti atkaklumÄ…. Motyvacija gali bÅ«ti skatinama Ä¯vairiÅ³ veiksniÅ³, tokiÅ³ kaip vidiniai norai, siekiai, vertybÄ—s, taip pat iÅ¡orinÄ—s aplinkybÄ—s, atlygis ar baimÄ— nepasiekti uÅ¾sibrÄ—Å¾to tikslo.\r\n\r\nÄ®prastai iÅ¡skiriamos dvi pagrindinÄ—s motyvacijos rÅ«Å¡ys: vidinÄ— ir iÅ¡orinÄ—. VidinÄ— motyvacija kyla iÅ¡ paÄio Å¾mogaus, jo noro mokytis, tobulÄ—ti, patirti naujus dalykus ir jausti pasitenkinimÄ… savo veikla. IÅ¡orinÄ— motyvacija yra skatinama iÅ¡oriniÅ³ veiksniÅ³, tokiÅ³ kaip atlygis, baimÄ—, socialinis spaudimas ar noras atitikti tam tikrus lÅ«kesÄius.\r\n\r\nNors abi motyvacijos rÅ«Å¡ys gali bÅ«ti naudingos siekiant tikslÅ³, vidinÄ— motyvacija daÅ¾niausiai laikoma labiau stabilia ir ilgalaike. Å½monÄ—s, motyvuoti iÅ¡ vidaus, labiau linkÄ™ atkakliai siekti savo tikslÅ³ net tada, kai susiduria su sunkumais, nes jauÄia vidinÄ¯ pasitenkinimÄ… savo veikla. Tuo tarpu iÅ¡oriÅ¡kai motyvuoti Å¾monÄ—s gali prarasti susidomÄ—jimÄ…, kai iÅ¡nyksta skatinantys iÅ¡oriniai veiksniai.', 8, 10),
(19, 'Motyvacijos praradimas gali bÅ«ti sudÄ—tinga problema, taÄiau yra daugybÄ— bÅ«dÅ³ jÄ… susigrÄ…Å¾inti. Å tai keletas patarimÅ³, kurie gali padÄ—ti jums motyvuoti save:\r\n\r\nNustatykite aiÅ¡kius tikslus: Pirmas Å¾ingsnis ieÅ¡kant motyvacijos â€“ tai aiÅ¡kiai apibrÄ—Å¾ti savo tikslus. Ko norite pasiekti? Kokie yra jÅ«sÅ³ ilgalaikiai ir trumpalaikiai siekiai? Kai Å¾inosite tai, ko norite, galÄ—site pradÄ—ti kurti planÄ…, kuriame bÅ«tÅ³ aiÅ¡kiai nurodoma kaip tai pasiekti.\r\n\r\nSuskaidykite didelius tikslus Ä¯ maÅ¾esnius: Dideli tikslai gali atrodyti gÄ…sdinantys ir atgrasÅ«s, todÄ—l juos suskaidykite Ä¯ maÅ¾esnius, lengviau Ä¯gyvendinamus Å¾ingsnius. Tai padÄ—s jaustis labiau kontroliuojantiems situacijÄ… ir padidins jÅ«sÅ³ motyvacijÄ….\r\n\r\nApdovanokite save uÅ¾ pasiekimus: Svarbu Å¡vÄ™sti savo pasiekimus nepaisant to, kokie maÅ¾i jie bebÅ«tÅ³. Apdovanodami save uÅ¾ atliktus darbus, sustiprinsite teigiamÄ… elgesÄ¯ ir padidinsite norÄ… toliau siekti savo tikslÅ³.\r\n\r\nIeÅ¡kokite palaikymo: Supkite save palaikanÄiais Å¾monÄ—mis, kurie tiki jumis ir jÅ«sÅ³ gebÄ—jimais. Palaikymas gali suteikti motyvacijos ir padrÄ…sinimo, kai to labiausiai reikia.\r\n\r\nPaÅ¡alinkite kliÅ«tis: AtsiÅ¾velkite Ä¯ tai, kas trukdo jums motyvuoti save. GalbÅ«t jus blaÅ¡ko aplinka, trÅ«ksta laiko ar iÅ¡tekliÅ³. NustaÄius kliÅ«tis galite imtis veiksmÅ³ jas paÅ¡alinti arba sumaÅ¾inti jÅ³ poveikÄ¯.\r\n\r\nPasirÅ«pinkite savimi: Svarbu rÅ«pintis savo fizine ir psichologine sveikata. Sveika mityba, reguliarus mankÅ¡tinimasis ir pakankamas miegas gali padidinti energijos lygÄ¯ ir pagerinti nuotaikÄ…, o tai gali lemti didesnÄ™ motyvacijÄ….\r\n\r\nNebijokite kreiptis pagalbos: Jei jums sunku motyvuoti save savo jÄ—gomis, kreipkitÄ—s pagalbos Ä¯ psichologÄ… ar kitÄ… psichikos sveikatos specialistÄ….\r\n\r\nAtminkite, kad motyvacija yra nuolatinis procesas. Kartais pakilimai bus aukÅ¡tesni, o kartais Å¾emesni. Svarbiausia â€“ nenustoti judÄ—ti pirmyn ir tikÄ—ti savimi bei savo gebÄ—jimais.\r\n\r\nBe Å¡iÅ³ patarimÅ³ galite iÅ¡bandyti ir kitus motyvacijos didinimo bÅ«dus, pavyzdÅ¾iui, vizualizacijÄ…, meditacijÄ… ar pozityvÅ³ savÄ™s Ä¯kalbÄ—jimÄ…. Svarbiausia rasti tai, kas jums tinka ir padeda jaustis motyvuotiems siekti savo tikslÅ³.', 8, NULL),
(20, 'Kai kuriais atvejais, kai motyvacija apleidÅ¾ia, kreiptis Ä¯ psichologÄ… gali bÅ«ti geriausia iÅ¡eitis. Specialistas gali padÄ—ti Å¡iais atvejais:\r\n\r\nNustatyti motyvacijos praradimo prieÅ¾astis: Psichologas padÄ—s jums suprasti, kas lemia jÅ«sÅ³ motyvacijos praradimÄ…. Tai gali bÅ«ti stresas, pervargimas, neaiÅ¡kÅ«s tikslai, nesÄ—kmÄ—s baimÄ—, Å¾ema savivertÄ— ar neigiama aplinka.\r\n\r\nSukurti individualÅ³ planÄ…: Specialistas dirbs kartu su jumis, kad sukurtÅ³ individualÅ³ planÄ…, kaip atgauti motyvacijÄ… ir pasiekti savo tikslus. Å is planas gali apimti Ä¯vairius metodus, tokius kaip kognityvinio elgesio terapija, pozityvaus savÄ™s Ä¯kalbÄ—jimo pratimai, tikslÅ³ nustatymas ir laiko valdymo technika.\r\n\r\nSuteikti palaikymÄ… ir padrÄ…sinimÄ…: Psichologas suteiks jums reikalingÄ… palaikymÄ… ir padrÄ…sinimÄ…, kad galÄ—tumÄ—te Ä¯veikti motyvacijos praradimo iÅ¡Å¡Å«kius. Jie padÄ—s jums tikÄ—ti savimi ir savo gebÄ—jimais.\r\n\r\nIÅ¡mokyti motyvacijos didinimo Ä¯gÅ«dÅ¾iÅ³: Psichologas iÅ¡mokys jus Ä¯vairiÅ³ motyvacijos didinimo Ä¯gÅ«dÅ¾iÅ³, kurie padÄ—s jums iÅ¡laikyti pozityvÅ³ poÅ¾iÅ«rÄ¯ ir judÄ—ti pirmyn.\r\n\r\nAtminkite, kad JÅ«s nesate vieni. Psichologas gali padÄ—ti jums Ä¯veikti sunkumus ir pasiekti savo tikslus. Å iuo metu Ä¯vairios konsultacijos teikiamos tiek internetu, tiek telefonu, tiek susitikus gyvam pokalbiui.', 8, 11),
(21, 'https://lengvosmintys.lt/motyvacija-kaip-motyvuoti-save/', 8, NULL),
(22, 'Sveika mityba â€“ tai tema, aktuali kiekvieno iÅ¡ mÅ«sÅ³ kasdieniniame gyvenime. Tai yra neatsiejama sveiko gyvenimo bÅ«do bei geros fizinÄ—s ir emocinÄ—s savijautos dalis. Jeigu domitÄ—s, kas yra sveika mityba, skaitykite toliau ir suÅ¾inokite pagrindines gaires, padÄ—sianÄias maitintis bei gyventi sveikiau!', 9, 12),
(23, 'Kas yra sveika mityba ir jos sudedamosios dalys?\r\nVaisiai ir darÅ¾ovÄ—s\r\nVaisiai ir darÅ¾ovÄ—s yra gausios vitaminÅ³, baltymÅ³, angliavandeniÅ³, mineraliniÅ³ druskÅ³ ir organiniÅ³ rÅ«gÅ¡ÄiÅ³. Tai yra Å¾mogaus organizmui bÅ«tinos medÅ¾iagos, todÄ—l vaisiai ir darÅ¾ovÄ—s â€“ vieni svarbiausiÅ³ produktÅ³ mÅ«sÅ³ racione. Besidomintys, kas yra sveika mityba, turÄ—tÅ³ Ä¯vertinti, kad be vaisiÅ³ ir darÅ¾oviÅ³ Ä¯traukimo, ji â€“ tiesiog neÄ¯manoma. \r\n \r\nRemiantis PasaulinÄ—s sveikatos organizacijos duomenimis, Å¾mogui rekomenduojama suvalgyti nuo 5 iki 7 porcijÅ³ vaisiÅ³ bei darÅ¾oviÅ³ arba kitaip â€“ bent 400 gramÅ³ per dienÄ…. Å iuos produktus rekomenduojama Ä¯traukti Ä¯ kiekvienÄ… dienos valgymÄ…. \r\n \r\nVaisius ir darÅ¾oves galima valgyti Å¾alius ar apdorotus â€“ virtus, troÅ¡kintus ir keptus. Ä® savo mitybÄ… Ä¯traukite ne tik Ä¯prastas darÅ¾oves, kaip morkas, burokÄ—lius, pomidorus ar agurkus, bet ir lapinius Å¾alumynus. NepamirÅ¡kite ir vitaminu C gausiÅ³ citrusiniÅ³ vaisiÅ³, melionÅ³ bei Ä¯vairiÅ³ uogÅ³.\r\nPilno grÅ«do produktai\r\nPilno grÅ«do produktai yra vieni tÅ³, kurie turÄ—tÅ³ sudaryti sveikos mitybos pagrindÄ…. Juose daug skaidulÅ³, reikalingÅ³ virÅ¡kinimui. Taip pat pilno grÅ«do produktai yra gausÅ«s sudÄ—tiniais angliavandeniais. Organizme jie yra skaidomi lÄ—tai, todÄ—l energijos suteikia ilgesniam laikui. \r\n\r\nRekomenduojama suvartoti nuo 225 iki 325 gramÅ³ angliavandeniÅ³ per dienÄ…, dÄ—l to pilno grÅ«do produktus taip pat galima Ä¯traukti Ä¯ kiekvienÄ… dienos valgymÄ…. Vengti reikÄ—tÅ³ tik greitai pasisavinamÅ³ angliavandeniÅ³, gaunamÅ³ iÅ¡ cukraus bei baltÅ³jÅ³ miltÅ³.\r\n \r\nAngliavandeniai yra energijos Å¡altinis. Kuo aksÄiau pradedate dienÄ…, tuo daugiau valgykite pilno grÅ«do produktÅ³ â€“ mieÅ¾iÅ³, aviÅ¾Å³, sorÅ³, speltos, grikiÅ³, bolivinÄ—s balandos, kukurÅ«zÅ³, laukiniÅ³ ryÅ¾iÅ³. Ä® mitybÄ… Ä¯traukite ir pilno grÅ«do dribsnius bei duonÄ….', 9, NULL);

-- Vertinimas

INSERT INTO `Vertinimas` (`id`, `vertinimas`, `sukurimo_data`, `vartotojas_id`, `straipsnis_id`) VALUES
(1, 8, '2024-11-30 10:15:00', 3, 1),
(2, 9, '2024-11-30 11:20:00', 3, 1),
(3, 7, '2024-11-30 12:30:00', 3, 2),
(4, 10, '2024-12-01 12:37:13', 3, 6),
(5, 2, '2024-12-01 12:37:27', 3, 3),
(6, 4, '2024-12-01 12:37:38', 3, 5),
(7, 10, '2024-12-01 12:48:58', 4, 1),
(8, 1, '2024-12-01 12:49:08', 4, 2),
(9, 10, '2024-12-01 12:49:18', 4, 7),
(10, 7, '2024-12-01 12:49:30', 4, 9),
(11, 4, '2024-12-01 12:49:38', 4, 3),
(12, 9, '2024-12-01 12:49:49', 4, 4),
(13, 9, '2024-12-01 12:49:59', 4, 5);
