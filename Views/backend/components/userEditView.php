<?php $title = 'Editer utilisateur'; ?>


<div class="container-login">

    <div class="main-container-form card">
        <div class="container-photo-profile">
            <div class="photo-profile">
            </div>
            <p class="text-connexion">Editer utilisateur</p>
        </div>

        <div class="container-form grid-x">
            <form action="index.php?action=editerUser" method="POST" class="small-10">
                <div class="form-group">
                    <span class="fas fa-user icon-user"></span>
                    <input type="text" name="user" id="user" placeholder="Utilisater" required>
                </div>

                <div class="form-group">
                    <span class="fas fa-lock icon-password"></span>
                    <input type="password" name="pass" id="pass" required placeholder="Mot de passe">
                </div>

                <div class="form-group group-mdp-oublie">
                    <p class="mdp-oublie">
                        <a class="mdp-oublie__link" href="index.php?action=forgotpassword">Mot de passe oublié?</a>
                    </p>
                </div>
                <div class="form-group group-valider">
                    <input class="btn-valider" type="submit" name="update" value="Mettre à jour">
                </div>
            </form>
        </div>
    </div>

