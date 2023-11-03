<?php
require_once(File::build_path(array("model", "modelAdmin.php")));
require_once(File::build_path(array("model", "modelRecipes.php")));
require_once(File::build_path(array("lib", "session.php")));

class controllerAdmin
{
    public static function isAdmin()
    {
        if (!isset($_SESSION['login'])) {
            return false;
        }
        if ($_SESSION['login']->users_type != 1) {
            return false;
        }
        return true;
    }

    public static function adminDashboard()
    {
        if (!controllerAdmin::isAdmin()) {
            controllerErreur::erreur("Vous n'avez pas les droits pour accéder à cette page.");
            return;
        }

        $pageTitle = "Tableau de bord - Administration";

        $awaitingRecipes = modelAdmin::getAwaitingRecipes();

        require(File::build_path(array("view", "navbar.php")));
        require(File::build_path(array("view", "adminDashboard.php")));
        require(File::build_path(array("view", "footer.php")));
    }

    public static function validRecipe()
    {
        if (!controllerAdmin::isAdmin()) {
            controllerErreur::erreur("Vous n'avez pas les droits pour accéder à cette page.");
            return;
        }
        if ($_GET['id'] == null) {
            controllerErreur::erreur("L'ID de la recette n'est pas renseigné.");
            return;
        }

        $recipe = modelRecipes::getRecipe($_GET['id']);
        if (!modelAdmin::validRecipe($_GET['id'])) {
            controllerErreur::erreur("La recette n'a pas pu être validée.");
            return;
        }

        controllerAdmin::adminDashboard();
    }
}