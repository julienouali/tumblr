<?php
class utilisateur{
	public $pseudo;
	private $password;
	private $id;
	
	//permet de créer un nouveau compte
	public static function nouveau($pseudo, $password){
		if(isset ($_SESSION['compte'])){ //compte définie (et non nulle).
			return;
		}
	}
	
	public static function connexion ($pseudo, $password){
		if(isset($_SESSION['compte'])){
			return;
		}
		$_SESSION['compte'] = MySQL::coCompte ($pseudo, $password);
		// La fonction coCompte($pseudo, $pass) devra retourner un objet de type Membre.
	}
	
	public static function deconnexion (){
	
	}
	
	//le constructeur de la classe
	function __construct(){
		
	}
}
?>