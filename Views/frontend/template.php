<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.0-rc.2/dist/css/foundation.min.css">
        <link href="public/css/styles.css" rel="stylesheet" />
    </head>
        
    <body>
        <header class ="grid-x main-header">
            <?php
                require('header.php');
            ?>
        </header>

        <?= $content; ?>

        <footer class="grid-x">
        <!-- footer content -->
<!--            --><?php
//                require('footer.php');
//            ?>
        </footer>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation-essential/6.2.2/js/vendor/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation-essential/6.2.2/js/vendor/what-input.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.0-rc.2/dist/js/foundation.min.js"></script>
    </body>
</html>