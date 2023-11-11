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
        if ($_SESSION['login'] == false) {
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
        $awaitingComments = modelAdmin::getAwaitingComments();
        $edito = modelAdmin::getCurrentEdito();

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

        header('Location: index.php?controller=admin&action=adminDashboard');
    }

    public static function validComment()
    {
        if (!controllerAdmin::isAdmin()) {
            controllerErreur::erreur("Vous n'avez pas les droits pour accéder à cette page.");
            return;
        }
        if (!isset($_GET['rec_id']) || !isset($_GET['users_id'])) {
            controllerErreur::erreur("Les paramètres n'ont pas été correctement renseignés.");
            return;
        }

        if (!modelAdmin::validComment($_GET['rec_id'], $_GET['users_id'])) {
            controllerErreur::erreur("Le commentaire n'a pas pu être validé.");
            return;
        }

        header('Location: index.php?controller=admin&action=adminDashboard');
    }

    public static function deleteComment() {
        if (!controllerAdmin::isAdmin()) {
            controllerErreur::erreur("Vous n'avez pas les droits pour accéder à cette page.");
            return;
        }
        if (!isset($_GET['rec_id']) || !isset($_GET['users_id'])) {
            controllerErreur::erreur("Les paramètres n'ont pas été correctement renseignés.");
            return;
        }

        if (!modelAdmin::deleteComment($_GET['rec_id'], $_GET['users_id'])) {
            controllerErreur::erreur("Le commentaire n'a pas pu être supprimé.");
            return;
        }

        header('Location: index.php?controller=admin&action=adminDashboard');
    }

    public static function edito() {
        if (!controllerAdmin::isAdmin()) {
            controllerErreur::erreur("Vous n'avez pas les droits pour accéder à cette page.");
            return;
        }
        if (!isset($_POST['edito_titre']) || !isset($_POST['edito'])) {
            controllerErreur::erreur("Les paramètres n'ont pas été correctement renseignés.");
            return;
        }

        if (!modelAdmin::addEdito($_SESSION['login']->users_id, $_POST['edito_titre'], $_POST['edito'])) {
            controllerErreur::erreur("L'éditorial n'a pas pu être mis à jour'.");
            return;
        }

        header('Location: index.php');
    }
}