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

            <form action="index.php?action=addPost" method="POST" class="small-12">

                <div class="form-group">
                    <input type="hidden" name="post-id" id="post-id" value="0">
                    <input type="text" name="titre" id="titre" placeholder="Titre de l'épisode" required>
                </div>

                <div class="form-group">
                    <label class="label-form" for="post-content">Contenu de votre épisode</label>
                    <textarea name="post-content" id="post-content" class="textarea-form" cols="30" rows="10">
                    </textarea>
                    <input type="file" name="img-post" id="img-post">
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
            <div class="news small-12 large-6">
                <div class="cell">
                    <div class="card">
                        <img src="https://images.pexels.com/photos/35637/alaska-glacier-ice-mountains.jpg?auto=compress" alt="" class="card__img">
                        <div class="card-section">
                            <a class="card__link" href="index.php?action=post&amp;id=<?= $data['id'] ?>">
                                <h3 class="card__title">
                                    <!-- Les parametres: ENT_COMPAT,'ISO-8859-1', true pour fixer le bug qui returne une valeur NULL qund il y a des mots avec d'accents -->
                                    <?= htmlspecialchars($data['title']) ?>
                                </h3>
                                <span class="news-date"><?= $data['created_date_fr'] ?></span>
                            </a>

                            <p class="card__text">
                                <?= substr(htmlspecialchars($data['content']), 0,200) .'...' ?>
                            </p>
                            <div class="card__btns grid-x">
                                <a class="card__comment-link far fa-comment" href="index.php?action=post&amp;id=<?= $data['id'] ?>"><span> <i class="nb-comments"><!-- mettre le nombre de commentaires dynamiquement pour ce billet --></i> Commentaires</span></a>
                                <a class="card__share-link fas fa-share-alt" href="#"> <span> Share</span></a>
                            </div>
                        </div>
                    </div>
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
