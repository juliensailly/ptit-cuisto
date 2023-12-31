<?php
require_once(File::build_path(array("controller", "controllerErreur.php")));

/* Contrôleur par défaut */
$controller = 'controllerAccueil';
$action = 'readAll';
global $recipe_img_path;
$recipe_img_path = 'resources/img/recipes_images/';

/* Chargement du contrôleur */
if (!isset($_GET['controller']) && !isset($_GET['action'])) {
	require(File::build_path(array("controller", "controllerAccueil.php")));
	$controller::$action();
} else {
	if (!isset($_GET['controller']) || empty($_GET['controller'])) {
		controllerErreur::erreur("Le contrôleur n'a pas été défini ou champs vides");
		return;
	}
	$controller = 'controller' . ucfirst($_GET['controller']);

	if (!file_exists(File::build_path(array('controller', $controller . '.php')))) {
		controllerErreur::erreur("Le contrôleur n'existe pas");
		return;
	}

	if ($controller != "controllerErreur") {
		require(File::build_path(array('controller', $controller . '.php')));
	}

	if (class_exists($controller)) {
		if (isset($_GET['action'])) {
			$action = $_GET['action'];
		} else if (isset($_POST['action'])) {
			$action = $_POST['action'];
		}
		$cl = get_class_methods($controller);

		if (in_array($action, $cl)) {
			$controller::$action();
		} else {
			controllerErreur::erreur("Action non existante");
		}
	}
}
