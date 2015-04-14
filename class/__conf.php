<?php
class __conf{
	private $sql;

	function MySQL(){
		$utilisateur = "root";
		$pass = "";
		$serveur = "localhost";
		$nomBase = "tumblr";
		$sql = new PDO('mysql:host=' . $serveur . ';dbname=' . $nomBase . ';charset=UTF-8', $utilisateur, $pass);
	}
	
	public static function coCompte($user, $password`){
		$login = $sql->prepare('SELECT * FROM `user` WHERE `password` = ? AND `pseudo` = ?');
		$login->execute(array($pass, $user));
		return $login->fetch(PDO::FETCH_OBJ);
	} 
}
?>