<?php
	$cible[0] = "/\[co\](.*?)\[\/co\]/si";
	$data[0] = isset($_SESSION['Compte']) ? "$1" : "";
	$cible[1] = "/\[inv\](.*?)\[\/inv\]/si";
	$data[1] = isset($_SESSION['Compte']) ? "" : "$1";
?>