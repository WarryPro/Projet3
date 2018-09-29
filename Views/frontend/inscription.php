<?php $title = 'inscription'; ?>

<?php ob_start(); ?>


<div class="grid-container">

    <form action="index.php?action=inscripuser" method="POST">
        <div class="row">
            <div class="large-12 columns">
                <label for="user">Utilisateur</label>
                <input type="text" name="user" id="user" placeholder="Utilisater" required>
            </div>
            <div class="large-12 columns">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="email">
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns">
                <label for="pass">Mot de passe</label>
                <input type="password" name="pass" id="pass" required placeholder="mot de passe">
            </div>

            <div class="large-12 columns">
                <p>
                    <a href="index.php?action=connexion">Déja un compte? se connecter</a>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="large-6 columns">
                <input type="submit" name="inscription" value="S'inscrire">
            </div>
        </div>
    </form>
</div>


<?php $content = ob_get_clean();
?>



<?php require('template.php'); ?>
