<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?> | Jean Forteroche</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.0-rc.2/dist/css/foundation.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link href="public/css/styles.css" rel="stylesheet" />
    </head>
        
    <body>
    <?php if (isset($_GET['action'])) {

        if ($_GET['action'] !== 'post') {

            print('<header class ="grid-x main-header">');

                if($_GET['action'] == 'billets' || $_GET['action'] == 'contact'
                    || $_GET['action'] == 'connexion' || $_GET['action'] == 'inscription') {

                    require('header.php');
                }

            print('</header>');
        }
    }
    else {
        print('<header class ="grid-x main-header">');
        require('header.php');
        print('</header>');
    }
    ?>

        <main class="grid-x grid-container">
            <?= $content; ?>
        </main>

        <footer class="grid-x">
            <?php require('footer.php'); ?>
        </footer>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation-essential/6.2.2/js/vendor/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation-essential/6.2.2/js/vendor/what-input.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.0-rc.2/dist/js/foundation.min.js"></script>
        <script>
            //Activer le menu responsive
            $('#menu-toggle').click(function(){
                $(this).toggleClass('open')
                $('.main-nav').toggleClass('show-menu')
            })
        </script>

        <script src="public/js/script.js"></script>
        <script src="public/js/alerts.js"></script>
    </body>
</html>