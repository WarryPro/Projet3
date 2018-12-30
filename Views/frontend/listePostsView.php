<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<div class="container-titre grid-x small-12">
    <h2 class="main-header__title">Liste de billets </h2>
</div>

<div class="billets-container grid-x small-12">
    <?php
    while ($data = $posts->fetch()) {
        ?>
        <div class="news small-12 medium-6 large-4">
            <div class="cell">
                <?php require('components/cards.php') ?>
            </div>
        </div>
        <?php
    }
    $posts->closeCursor();
    ?>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>