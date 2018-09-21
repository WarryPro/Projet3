<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<div class="derniers-billets grid-x small-12">
    <h2 class="main-header__title">Derniers billets </h2>
</div>
<?php
while ($data = $posts->fetch()) {
?>
    <div class="news small-12 medium-6 large-4">
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
                        <a class="card__comment-link far fa-comment" href="index.php?action=post&amp;id=<?= $data['id'] ?>"><span> <i class="nb-comments"> 14</i> Commentaires</span></a>
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

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>