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
    <div class="alert-container">
        <?php echo $sessionController -> getFlash();
        unset($_SESSION['flash']);
        ?>
    </div>
    <form id="form-editer-profil" action="index.php?action=editprofil" method="POST" enctype="multipart/form-data" class="form form-edit-profil grid-x align-center">
        <button title="Éditer profil" id="btn-editer-profil" class="button warning editer"><i class="fas fa-pencil-alt"></i></button>
        <button title="annuler" id="btn-annuler" class="button error hide"><i class="fas fa-times"></i></button>
        <div class="profil-image">
            <img src="./<?= $user["user_image"]; ?>" alt="Image profil" class="image">
            <input type="file" name="image-profil" multiple id="input-image-profil" class="button hide">
            <label id="editer-image-profil" for="input-image-profil" class="button hide"><i class="fas fa-pencil-alt"></i></label>
        </div>
        <div class="profil profil__name text-center pd-t small-12">
            <h2 class="profil__nom"><?= $user["user"]; ?></h2>
            <p class="profil__role"><?= $user["user_role"]; ?></p>
        </div>
        <div class="profil profil__coords small-12 text-center">
            <div class="form-group">
                <a href="mailto:<?= $user["email"];?>" class="profil__email"><?= $user["email"];?></a>
            </div>
            <div id="changermdp" class="form-group hide">
                <p class="text-center">Changer le mot de passe</p>
                <input type="password" id="current-pass" name="current-password" placeholder="mot de passe actuel">
                <input type="password" id="new-pass" name="new-password" placeholder="Nouvel mot de passe">
            </div>

            <button type="submit" id="maj-profil" class="btn success hide">Mettre à jour</button>

        </div>
    </form>
</div>

<div class="container-profil profil-content small-12 medium-auto grid-x">
    <div class="small-12 text-center pd-b">
        <h3 class="card__title pd-b">Épisodes que vous avez commenté</h3>
    </div>
    <?php
    //Recuperer les infos de chaque épisode
    if($episodes) {
        foreach ($episodes as $data) {
            ?>
            <div class="news small-12 medium-6">
                <?php require('./Views/frontend/components/cards.php') ?>
            </div>
            <?php
        }
    }
    ?>
</div>


<?php
    $content = ob_get_clean();
    require('./Views/frontend/template.php');
?>