<?php $title = 'Editer utilisateur'; ?>


<div id="modal" class="container-login container-user-edit hide">
    <div class="main-container-form card">
        <div id="reponse"></div>
        <div id="btn-close" class="btn-close"></div>
        <div class="container-photo-profile">
            <div class="photo-profile">
            </div>
            <p class="text-connexion">Editer utilisateur</p>
        </div>
        <div class="container-form grid-x">
<!--            action="index.php?action=updateuser"-->
            <form action="index.php?action=updateuser" id="form-user--edit" method="POST" class="small-10">
                <input type="hidden" name="user-id" id="user-id" value="">
                <div class="form-group">
                    <span class="fas fa-user icon-user"></span>
                    <input type="text" name="user" id="user-name" placeholder="Utilisater" value="" required>
                </div>

                <div class="form-group">
                    <span class="fas fa-envelope icon-email"></span>
                    <input type="text" name="email" id="email" placeholder="Email" value="">
                </div>

                <div class="form-group">
                    <span class="fas fa-lock icon-password"></span>
                    <input type="password" name="current-pass" id="current-pass" placeholder="Actuel mot de passe">
                </div>

                <div class="form-group">
                    <span class="fas fa-lock icon-password"></span>
                    <input type="password" name="new-pass" id="new-pass" placeholder="Nouveau mot de passe">
                </div>

                <div class="form-group radio">
                    <input class="radio-form" id="user-user" type="radio" name="user_role" value="User">
                    <label class="label-form" for="user-user">User</label>

                    <input class="radio-form" id="user-admin" type="radio" name="user_role" value="Admin">
                    <label class="label-form" for="user-admin">Admin</label>
                </div>
                <div class="form-group group-valider">
                    <input class="btn-valider" type="submit" name="update" value="Mettre à jour">
                </div>
            </form>
        </div>
    </div>
</div>

