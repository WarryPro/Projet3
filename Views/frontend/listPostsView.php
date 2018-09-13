<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Mon testBlog !</h1>
<p>Derniers billets du blog :</p>


<?php
while ($data = $posts->fetch()) {
?>
    <div class="news">
        <h3>
            <!-- Les parametres: ENT_COMPAT,'ISO-8859-1', true pour fixer le bug qui returne une valeur NULL qund il y a des mots avec d'accents -->
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['created_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= nl2br(htmlspecialchars($data['content'])) ?>
            <br />
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>