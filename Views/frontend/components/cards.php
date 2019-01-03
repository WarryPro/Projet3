<?php
use Controllers\ViewController;

$viewController = New ViewController();
?>
<div class="card">
    <?php

        $viewController -> adminCrudBtn();

        $image = htmlspecialchars($data['image_episode']);

        if($image !== '') {

            print_r('<img src="'.$image.'" alt="" class="card__img">');
        }
        else {
            print_r('<img src="https://images.pexels.com/photos/35637/alaska-glacier-ice-mountains.jpg?auto=compress" alt="" class="card__img">');
        }
    ?>
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