<?php
//nustatymai.php
define("DB_SERVER", "localhost");
define("DB_USER", "stud");
define("DB_PASS", "stud");
define("DB_NAME", "vartvald");
define("TBL_USERS", "users");

// Vartotojų profiliai
$user_roles=array(      // vartotojų rolių vardai ir  atitinkamos userlevel reikšmės
	"Administratorius"=>"9",
	"Dalyvis"=>"4",
	"Vadovas"=>"5",);   
// automatiškai galioja ir vartotojas "guest",rolė "Svečias",  userlevel=0
//   jam irgi galima nurodyti leidžiamas operacijas

define("DEFAULT_LEVEL","Dalyvis");  // kokia rolė priskiriama kai registruojasi
define("ADMIN_LEVEL","Administratorius");  // jis turi vartotojų valdymo teisę per "Administratoriaus sąsaja"
define("UZBLOKUOTAS","255");      // vartotojas negali prisijungti kol administratorius nepakeis rolės
$uregister="both";  // kaip registruojami vartotojai:
					// self - pats registruojasi, admin - tik ADMIN_LEVEL, both - abu atvejai

// Operacijų meniu
// Automatiškai rodomi punktai "Redaguoti paskyrą" ir "Atsijungti", 
//  							o Administratoriui dar "Administratoriaus sąsaja"
// Kitų operacijų meniu aprašomas kintamuoju $usermenu:
// operacijos pavadinimas
// kokioms rolėms rodoma
// operacijos modulis

$usermenu=array(
	["Demo operacija-1",[0,4,5,9],"operacija1.php"],
	["Mano zinutes",[4,5,9],"skaitau.php"],
	["Demo operacija-3",[4,5,9],"operacija3.php"],
			  ); 

// karkaso vaizdavimą paredaguokite savo stiliumi keisdami top.png (pradinis yra 1027x122, read teisė visiems)
// ir styles.css.
// top.png pageidautina matyti sistemos pavadinimą ir autorių.

