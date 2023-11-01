<div class="sign-up-background" style="display: none;">
    <div class="sign-in-window">
        <div class="sign-in-header">
            <h3>Connexion</h3>
            <img src="resources/img/xmark-solid.svg" alt="xmark icon" class="xmark">
        </div>
        <form action="index.php?controller=sign&action=signIn" method="POST">
            <div>
                <label for="sign-in-mail">Adresse mail :</label>
                <input type="email" id="sign-in-mail" name="sign-in-mail" class="form-control" required>
            </div>
            <div>
                <label for="sign-in-password">Mot de passe :</label>
                <input type="password" id="sign-in-password" name="sign-in-password" class="form-control" required>
            </div>
            <input type="submit" class="btn btn-primary" value="Se connecter">
        </form>
        <p>Vous n'avez pas de compte ?<br><span class="sign-up-link">Inscrivez-vous</span></p>
    </div>

    <div class="sign-up-window" style="display: none;">
        <div class="sign-in-header">
            <h3>Inscription</h3>
            <img src="resources/img/xmark-solid.svg" alt="xmark icon" class="xmark">
        </div>
        <form action="index.php?controller=sign&action=signUp" method="POST">
            <div id="name-inputs">
                <div>
                    <label for="name">Prénom :</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div>
                    <label for="surname">Nom :</label>
                    <input type="text" id="surname" name="surname" class="form-control" required>
                </div>
            </div>
            <div>
                <label for="pseudo">Pseudonyme :</label>
                <input type="text" id="pseudo" name="pseudo" class="form-control" required>
            </div>
            <div>
                <label for="sign-up-mail">Adresse mail :</label>
                <input type="email" id="sign-up-mail" name="sign-up-mail" class="form-control" required>
            </div>
            <div>
                <label for="sign-up-password">Mot de passe :</label>
                <input type="password" id="sign-up-password" name="sign-up-password" class="form-control" required>
            </div>
            <div>
                <label for="password2">Confirmer le mot de passe :</label>
                <input type="password" id="password2" name="password2" class="form-control" required>
            </div>
            <input type="submit" class="btn btn-primary" value="S'inscrire">
        </form>
        <p>Vous avez déjà un compte ?<br><span class="sign-in-link">Connectez-vous</span></p>
    </div>
</div>