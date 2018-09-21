<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.0-rc.2/dist/css/foundation.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link href="public/css/styles.css" rel="stylesheet" />
    </head>
        
    <body>
        <header class ="grid-x main-header">
            <?php
                require('header.php');
            ?>
        </header>

        <main class="grid-x grid-container">
            <?= $content; ?>
        </main>

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