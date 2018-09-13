<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>


<main class="grid-container main-container grid-x">
    <p><a class="btn-primary" href="index.php">Retour à la liste des billets</a></p>
    <div class="cell">
            <div class="news-container grid-y">
                <div class="news-title cell">
                    <h1>
                        <?= htmlspecialchars($post['title']) ?>
                    </h1>
                    <span class="news-date"><em><?= $post['created_date_fr'] ?></em></span>
                </div>
                <div class="news-content cell">
                    <p>
                        <?= nl2br(htmlspecialchars($post['content'])) ?>
                    </p>
                </div>
        </div>
    </div>

    <div class="cell grid-x main-container form-comments">
        <div class="grid-container main-container form-comments grid-x cell">
            <h2 class="cell subtitle">Commentaires</h2>
        <div class="cell grid-container grid-x container-form">
            <form class="cell small-6" action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
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
        <div class="container-comments grid-container cell">
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
</main>
