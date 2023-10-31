<?php
class controllerErreur{
	public static function erreur($message){
		$pageTitle = "Erreur !";
		require (File::build_path(array("view", "navbar.php")));
		require File::build_path(array("view", "erreur.php"));
		echo $message;
		echo "<br><a href=\"index.php\">Retour à l'accueil</a>";
		require (File::build_path(array("view", "footer.php")));
	}
}
