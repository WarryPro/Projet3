<?php $title = 'Mon profil';
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 25/12/2018
 * Time: 22:46
 */
$sessionController = New \Controllers\SessionController();

 ob_start();

 ?>

<div class="container-titre grid-x small-12">
    <h2 class="main-header__title">Mon profil</h2>
</div>

<div class="container-profil profil-info small-12 medium-4 large-3">
    <form id="form-editer-profil" action="editprofil.php" class="form form-edit-profil grid-x align-center">
        <button title="Éditer profil" id="btn-editer-profil" class="button warning editer"><i class="fas fa-pencil-alt"></i></button>
        <button title="annuler" id="btn-annuler" class="button error hide"><i class="fas fa-times"></i></button>
        <div class="profil-image">
            <img src="./public/images/user.svg <?php ?>" alt="Image profil" class="image">
            <button id="editer-image-profil" class="button hide"><i class="fas fa-pencil-alt"></i></button>
        </div>
        <div class="profil profil__name text-center pd-t">
            <h2 class="profil__nom">Dany Restrepo</h2>
            <p class="profil__role">Administrateur</p>
        </div>
        <div class="profil profil__coords small-12 text-center">
            <div class="form-group">
                <a href="mailto:dannyfr.03@gmail.com" class="profil__email">Dannyfr.03@gmail.com</a>
            </div>
            <div id="changermdp" class="form-group hide">
                <p class="text-center">Changer le mot de passe</p>
                <input type="password" id="current-pass" name="new-password" placeholder="mot de passe actuel">
                <input type="password" id="new-pass" name="new-password" placeholder="Nouvel mot de passe">
            </div>

            <button type="submit" id="maj-profil" class="btn success hide">Mettre à jour</button>

        </div>
    </form>
</div>

<div class="container-profil profil-content small-12 medium-auto">

</div>


<?php
    $content = ob_get_clean();
    require('./Views/frontend/template.php');
?>