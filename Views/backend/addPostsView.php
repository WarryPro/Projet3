<?php $title = 'Admin';
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 25/12/2018
 * Time: 22:46
 */
?>


<?php ob_start(); ?>


<div class="grid-x small-12 pd-top-btm">
    <div class="small-12 text-center pd-top-btm">
        <h2>Gestion d'épisodes</h2>
    </div>
    <div class="small-12 large-5 add-post">
        <div class="small-12 add-post__container-form">

            <form action="index.php?action=addPost" method="POST" enctype="multipart/form-data" class="add-post__form small-12">

                <div class="form-group">
                    <input type="hidden" name="post-id" id="post-id" value="0">
                    <input type="text" name="titre" id="titre" class="add-post__titre" placeholder="Titre de l'épisode" required>
                </div>

                <div class="form-group">
                    <label class="label-form add-post__label-content" for="post-content">Contenu de votre épisode</label>
                    <textarea name="post-content" id="post-content" class="textarea-form" cols="30" rows="10">
                    </textarea>
                    <input type="file" class="add-post__file" name="img-post" multiple id="img-post">
                    <label for="img-post" class="label-form add-post__label-file"><i class="fas fa-image"></i> Ch. image</label>
                </div>

                <div class="btn-container">
                    <input class="btn-form"type="submit" />
                </div>

            </form>

        </div>
    </div>


    <div class="small-12 large-7 grid-x admin-post-container">
        <?php
        if(isset($_SESSION['flash'])) {
            echo('<div id="alert-container" class="alert-container small-12">');
                $message = New \Controllers\SessionController();
                $message -> getFlash();
                unset($_SESSION['flash']); // Supp la session pour cette var
            echo('</div>');
        }
        //Recuperer les infos de chaque épisode
        foreach ($result[1] as $data) {
            ?>
            <div class="news small-12 medium-6">
                <div class="cell">
                    <?php require('./Views/frontend/components/cards.php') ?>
                </div>
            </div>
            <?php
        }
//        $posts->closeCursor();
        ?>
        <!--pagination component-->
        <div class="container align-center rid-x small-12">
            <?php  require('./Views/frontend/components/pagination.php');?>
        </div>
    </div>
</div>


<!--Bloque gestion de commentaires -->
<div class="grid-x small-12 pd-top-btm">
    <div class="small-12 text-center">
        <h2>Gestion de commentaires signalés </h2>
    </div>
    <?php
        require('components/commentsManagerView.php');
    ?>
</div>

<!--Bloque gestion d'utilisateurs-->
<div class="grid-x small-12 pd-top-btm">
    <div class="small-12 text-center">
        <h2>Gestion d'utilisateurs</h2>
    </div>
    <?php
        require('components/usersManagerView.php');
    ?>
</div>


<?php $content = ob_get_clean();
?>



<?php require('./Views/frontend/template.php'); ?>
