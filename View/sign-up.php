<div class="sign-up-background">
    <div class="sign-up-window" style="display: none;">
        <div class="sign-in-header">
            <h3>Connexion</h3>
            <img src="resources/img/xmark-solid.svg" alt="xmark icon" class="xmark">
        </div>
        <form action="javascript:signUp()">
            <div>
                <label for="mail">Adresse mail :</label>
                <input type="email" id="mail" name="mail" class="form-control" required>
            </div>
            <div>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <input type="submit" class="btn btn-primary" value="Se connecter">
        </form>
        <p>Vous n'avez pas de compte ?<br><span class="sign-in-link">Inscrivez-vous</span></p>
    </div>

    <div class="sign-in-window">
        <div class="sign-in-header">
            <h3>Inscription</h3>
            <img src="resources/img/xmark-solid.svg" alt="xmark icon" class="xmark">
        </div>
        <form action="javascript:signIn()">
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
                <label for="mail">Adresse mail :</label>
                <input type="email" id="mail" name="mail" class="form-control" required>
            </div>
            <div>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div>
                <label for="password2">Confirmer le mot de passe :</label>
                <input type="password" id="password2" name="password2" class="form-control" required>
            </div>
            <input type="submit" class="btn btn-primary" value="S'inscrire'">
        </form>
        <p>Vous avez déjà un compte ?<br><span class="sign-up-link">Connectez-vous</span></p>
    </div>
</div>