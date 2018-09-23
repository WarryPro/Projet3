<?php $title = 'connection'; ?>

<?php ob_start(); ?>

<div class="grid-container">

    <form action="index.php?action=connectuser" method="POST">
        <div class="row">
            <div class="large-12 columns">
                <label for="user">Utilisateur</label>
                <input type="text" name="user" id="user" placeholder="Utilisater" required>
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns">
                <label for="pass">Mot de pass</label>
                <input type="password" name="pass" id="pass" required>
            </div>
            <div class="large-12 columns">
                <p>
                    <a href="index.php?action=forgotpassword">j'ai oublié mon mot de passe</a>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="large-6 columns">
                <input type="submit" name="Connection" value="Se connecter">
            </div>
        </div>
    </form>
</div>


<?php $content = ob_get_clean();
?>



<?php require('template.php'); ?>
