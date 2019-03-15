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
    <div class="profil-image">
        <img src="./public/images/user.svg <?php ?>" alt="Image profil" class="image">
    </div>
    <div class="profil profil__name text-center pd-t">
        <h2 class="profil__nom">Dany Restrepo</h2>
        <p class="profil__role">Administrateur</p>
    </div>
    <div class="profil profil__coords text-center">
        <a href="mailto:dannyfr.03@gmail.com" class="profil__email">Dannyfr.03@gmail.com</a>

    </div>
</div>

<div class="container-profil profil-content small-12 medium-auto">

</div>


<?php
    $content = ob_get_clean();
    require('./Views/frontend/template.php');
?>