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
    <div class="small-12 large-5 add-post">

        <div class="small-12 add-post__container-form">

            <form action="index.php?action=addPost" method="POST" enctype="multipart/form-data" class="small-12">

                <div class="form-group">
                    <input type="hidden" name="post-id" id="post-id" value="0">
                    <input type="text" name="titre" id="titre" placeholder="Titre de l'épisode" required>
                </div>

                <div class="form-group">
                    <label class="label-form" for="post-content">Contenu de votre épisode</label>
                    <textarea name="post-content" id="post-content" class="textarea-form" cols="30" rows="10">
                    </textarea>
                    <input type="file" name="img-post" multiple id="img-post">
                </div>

                <div class="btn-container">
                    <input class="btn-form"type="submit" />
                </div>

            </form>

        </div>
    </div>


    <div class="small-12 large-7 grid-x">
        <?php
        while ($data = $posts->fetch()) {
            ?>
            <div class="news small-12 medium-6">
                <div class="cell">
                    <?php require('./Views/frontend/components/cards.php') ?>
                </div>
            </div>
            <?php
        }
        $posts->closeCursor();
        ?>
    </div>
</div>


<?php $content = ob_get_clean();
?>



<?php require('./Views/frontend/template.php'); ?>
