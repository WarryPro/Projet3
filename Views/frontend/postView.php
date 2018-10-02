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
                        <?= nl2br(htmlspecialchars($post['content'])) ?>
                    </p>
                </div>
            </div>
        </div>

        <div class=" grid-x post-main-container form-comments">
            <div class="grid-container post-main-container form-comments grid-x ">
                <h2 class=" subtitle">Commentaires</h2>
            <div class=" grid-container grid-x container-form">
                <form class=" small-6" action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                    <div class="input-form">
                        <label for="user">Utilisateur</label><br />
                        <input type="text" id="user" name="user" />
                    </div>
                    <div class="input-form">
                        <label for="comment">Commentaire</label><br />
                        <textarea id="comment" name="comment"></textarea>
                    </div>
                    <div class="btn-container">
                        <input class="btn-primary btn-form"type="submit" />
                    </div>
                </form>
            </div>
            <div class="container-comments grid-container ">
                <?php
                while ($comment = $comments->fetch()) {
                ?>

                    <p><strong><?= htmlspecialchars($comment['user']) ?></strong>

                    <span class="comment-date">le <?= $comment['comment_date_fr'] ?></span> </p>

                    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                <?php
                }
                ?>
                <?php $content = ob_get_clean(); ?>

                <?php require('template.php'); ?>

            </div>
        </div>
        </div>
    </div>
</section>
