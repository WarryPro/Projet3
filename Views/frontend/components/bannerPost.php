<div class="banner-post banner">
    <?php
        $image = htmlspecialchars($post['image_episode']);

        if($image !== '') {

            echo('<img src="'.$image.'" alt="Banner" class="banner__img">');
        }
        else {
            echo('<img src="https://images.pexels.com/photos/35637/alaska-glacier-ice-mountains.jpg?auto=compress" alt="Banner" class="banner__img">');
        }
    ?>
</div>