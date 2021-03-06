<?php $title = 'Editer post';
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 06/01/2019
 * Time: 01:37
 */
?>

<?php ob_start(); ?>


<div class="small-12 large-8 editer-post pd-top-btm">
    <h2 class="text-center">Éditer l'épisode</h2>
    <div class="small-12 editer-post__container-form">

        <form action="index.php?action=updatePost" method="POST" enctype="multipart/form-data" class="small-12">

            <div class="form-group">
                <input type="hidden" name="post-id" id="post-id" value="<?php echo($post['id'])?>">
                <input type="text" name="titre" id="titre" class="editer-post__titre" placeholder="Titre de l'épisode" value="<?php echo($post['title']) ?>" required>
            </div>

            <div class="form-group">
                <label class="label-form editer-post__label-content" for="post-content">Contenu de votre épisode</label>
                <textarea name="post-content" id="post-content" class="textarea-form" cols="30" rows="10">
                    <?php echo($post['content']) ?>
                </textarea>
                <input type="file" class="editer-post__file" name="img-post" multiple id="img-post">
                <label for="img-post" class="label-form editer-post__label-file"><i class="fas fa-image"></i> Ch. image</label>
            </div>

            <div class="btn-container">
                <input class="btn-form" type="submit" />
            </div>

        </form>

    </div>
</div>


<?php $content = ob_get_clean(); ?>



<?php require('./Views/frontend/template.php'); ?>
