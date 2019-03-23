<?php $title = 'Mon blog'; ?>

<?php ob_start();

$sessionController = New Controllers\SessionController();
?>

<div class="container-titre grid-x small-12">
    <h2 class="main-header__title">Derniers billets </h2>
</div>

<div class="derniers-billets grid-x small-12">
    <div class="alert-container small-12">
        <?php echo $sessionController -> getFlash();
        unset($_SESSION['flash']);
        ?>
    </div>
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