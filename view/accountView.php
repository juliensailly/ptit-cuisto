<?php global $recipe_img_path; ?>

<h2>Tableau de bord - Utilisateurs</h2>

<div class="profil_header">
    <div>
        <div class="user_pp" <?php
        srand($user->users_id);
        $randColor = "#" . str_pad(dechex(rand(0xb9b9b9, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
        echo "style=\"background-color: $randColor;\"";
        ?>>
            <span>
                <?= strtoupper(substr($user->users_pseudo, 0, 1)) ?>
            </span>
        </div>
    </div>
    <div>
        <h3><?= $user->users_pseudo ?></h3>
        <p><?= $user->users_name ?> <?= $user->users_lastname ?></p>
        <p>Inscrit depuis le <?= date("d/m/Y", strtotime($user->users_inscription_date)) ?></p>
        <p>Responsable de <?= date("d/m/Y", strtotime($user->users_inscription_date)) ?></p>
    </div>
</div>
