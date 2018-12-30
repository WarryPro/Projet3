<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>


<section class="post-main-container grid-x">

    <?php require('postAside.php') ?>

    <div class="post-container small-12 medium-8 large-9">

        <?php require('partials/bannerPost.php') ?>

        <div class="small-12 medium-8 large-9">
            <div class="post grid-y">
                <div>
                    <h2 class="post-title">
                        <?= htmlspecialchars($post['title']) ?>
                    </h2>
                    <span class="post-date"><em><?= $post['created_date_fr'] ?></em></span>
                </div>
                <div class="post-content-container ">
                    <p class="post-content">
                        <?= htmlspecialchars($post['content']) ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="post form-comments grid-x">
            <div class="container-form card">
                <form class=" small-12" action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
<!--                    <div class="input-form">-->
<!--                        <label for="user">Utilisateur</label><br />-->
<!--                        <input type="text" id="user" name="user" />-->
<!--                    </div>-->
                    <div class="input-form">
                        <label class="label-form" for="comment">Laissez un commentaire</label>
                        <textarea class="textarea-form" id="comment" name="comment"></textarea>
                    </div>
                    <div class="btn-container">
                        <input class="btn-form"type="submit" />
                    </div>
                </form>
            </div>
            <div class="container-comments small-12">
                <?php
                while ($comment = $comments->fetch()) {
                ?>
                    <div class="comment">

                        <div class="user">

                            <a href="#" class="user__photo">
                                <img src="public/images/dany.JPG" alt="user-photo" class="user__img">
                            </a>

                            <div class="grid-y">
                                <a href="#" class="user__nom"><strong><?= htmlspecialchars($comment['user']) ?></strong></a>
                                <span class="user__date"><?= $comment['comment_date_fr'] ?></span>
                                <p class="comment__user-comment"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <?php $content = ob_get_clean(); ?>

                <?php require('template.php'); ?>

            </div>
        </div>
    </div>
</section>
