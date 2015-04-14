<?php
session_start();
function __autoload($classe){ // Permet de trouver les fichiers des classes utilisées
	include '/classe/'.$classe.'.php4';
}

switch($_GET['action']){ //apparait sous la forme de ?action=... dans l'url
	case "connexion" : utilisateur::connexion($pseudo, $pass);
	break;
	case "deconnexion" : utilisateur::deconnexion();
	break;
	case "inscription" : utilisateur::inscription($pseudo, $pass);
	break;	
	default : PageWeb($_GET['page']); // si nul
}

function PageWeb($nom){
		if(!isset($nom)){
			$nom = "index";
		}
		$html = file_get_contents("template/" . $nom . "/page.html");
		if ($html === false) {
			die("[FATAL] Une erreur est survenue lors de la lecture de la page web.");
		}
		if(file_exists("template/" . $nom . "/script.php")){
			include("template/" . $nom . "/script.php");
		}
		echo preg_replace($cible, $data, $html);
	}
}
?>