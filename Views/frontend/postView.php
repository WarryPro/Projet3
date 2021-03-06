<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start();

use Controllers\CommentController;
use Controllers\SessionController;

$commentController = New CommentController();
$sessionController = New SessionController();

?>


<section class="post-main-container grid-x">

    <?php require('postAside.php') ?>

    <div class="post-container small-12 medium-8 large-9">

        <?php require('components/bannerPost.php');
        echo $sessionController -> getFlash();
        unset($_SESSION['flash']);
        ?>

        <div class="small-12 medium-8 large-9">
            <div class="post grid-y">
                <div>
                    <h2 class="post-title">
                        <?= htmlspecialchars($post['title']) ?>
                    </h2>
                    <span class="post-date"><em><?= $post['created_date_fr'] ?></em></span>
                </div>
                <div class="post-content-container ">
<!--                    <p class="post-content">-->
                        <?= $post['content'] ?>
<!--                    </p>-->
                </div>
            </div>
        </div>


        <div class="post form-comments grid-x">
            <?php

            $sessionUser = $sessionController -> getCurrentUser();
            if(isset($sessionUser)) { ?>
                <div class="container-form card">
                    <form class=" small-12" action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                        <div class="input-form">
                            <label class="label-form" for="comment">Laissez un commentaire</label>
                            <textarea class="textarea-form" id="comment" name="comment"></textarea>
                        </div>
                        <div class="btn-container">
                            <input class="btn-form"type="submit" />
                        </div>
                    </form>
                </div>
            <?php
            } // Fermeture du if
            else {
                echo ("<div class='container-form card'>
                            <p>Pour commenter vous devez <a href='./index.php?action=inscription'>s'inscrire</a> ou 
                                <a href='./index.php?action=connexion'>se connecter</a>
                            </p>
                    </div>");
            }
            ?>

            <!--  Affichage des commentaires -->
            <div class="container-comments small-12">
                <?php
                while ($comment = $comments->fetch()) {
                ?>
                    <div class="comment">

                        <div class="user">

                            <a href="#" class="user__photo">
                                <img src="public/images/user.svg" alt="user-photo" class="user__img">
                            </a>

                            <div data-id="<?= htmlspecialchars($comment['id'])?>" class="grid-y user-info">
                                <a href="#" class="user__nom"><strong><?= htmlspecialchars($comment['user']) ?></strong></a>
                                <span class="user__date"><?= $comment['comment_date_fr'] ?></span>
                                <p class="comment__user-comment"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                                <?php

                                    $sessionUser = $sessionController -> getCurrentUser();

                                    if (!isset($sessionUser)) {
                                        NULL; // s'il n'y a pas session on ne fait rien
                                    }

                                    // si l'utilisateur a déjà signalé le commentaire ou pas
                                    elseif(!$commentController -> userHasReported($comment['id'])) {
                                        echo("<a id=". $comment['id'] . " class='btn signaler' href='#modal'>Signaler</a>");
                                    }

                                    else {
                                        echo("<p class='label warning'>Vous avez signalé ce commentaire</p>");
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                }

                require ('components/modalSignaler.php');?>

                <?php $content = ob_get_clean(); ?>

                <?php require('template.php'); ?>

            </div>
        </div>
    </div>
</section>
