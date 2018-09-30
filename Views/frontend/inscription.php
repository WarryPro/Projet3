<?php $title = 'inscription'; ?>

<?php ob_start(); ?>


<div class="small-10 medium-6 large-4 grid-container container-logout">

    <div class="main-container-form card">
        <div class="container-photo-profile">
            <div class="photo-profile">

            </div>
            <p class="text-connexion">S'inscrire</p>
        </div>

        <div class="container-form grid-x">
            <form action="index.php?action=inscripuser" method="POST" class="small-10">
                <div class="form-group">
                    <span class="fas fa-user icon-user"></span>
                    <input type="text" name="user" id="user" placeholder="Utilisater" required>
                </div>

                <div class="form-group">
                    <span class="fas fa-envelope icon-email"></span>
                    <input type="text" name="email" id="email" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <span class="fas fa-lock icon-password"></span>
                    <input type="password" name="pass" id="pass" required placeholder="Mot de passe">
                </div>


                <div class="form-group group-valider">
                    <input class="btn-valider" type="submit" name="inscription" value="S'inscrire">
                    <p> Vous avez déjà un compte?
                        <a class="creer-compte__link" href="index.php?action=connexion">se connecter</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>


<?php $content = ob_get_clean();
?>



<?php require('template.php'); ?>
