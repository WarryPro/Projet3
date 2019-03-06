<?php $title = 'connection'; ?>

<?php ob_start(); ?>

<div class="container-login">

    <div class="main-container-form card">
        <?php
            $error = New \Controllers\SessionController();
            echo $error -> getFlash();
            unset($_SESSION['flash']); // Supp la session pour cette var
        ?>
        <div class="container-photo-profile">
            <div class="photo-profile">
            </div>
            <p class="text-connexion">Se connecter</p>
        </div>

        <div class="container-form grid-x">
            <form action="index.php?action=connectuser" method="POST" class="small-10">
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
                    <input class="btn-valider" type="submit" name="Connection" value="Se connecter">
                    <p> Vous n'avez pas de compte?
                        <a class="creer-compte__link" href="index.php?action=inscription">créer un maintenant!</a>
                    </p>
                </div>
            </form>
        </div>
    </div>


<?php $content = ob_get_clean();
?>



<?php require('template.php'); ?>
