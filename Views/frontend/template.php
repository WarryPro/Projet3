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

    <?php

    if (isset($_GET['action'])) {

        $action = strip_tags(trim($_GET['action']));

        if ($action !== 'post') {

            print('<header class ="grid-x main-header">');

                if($action == 'billets' || $action == 'contact'
                    || $action == 'connexion' || $action == 'inscription'
                    || $action == 'admin' || $action == 'editer') {

                    require('header.php');
                }

            print('</header>');
        }
    }
    else {
        echo '<header class ="grid-x main-header">';

            require 'header.php';

        echo '</header>';
    }
    ?>

        <main class="grid-x cell align-center grid-container">
            <?= $content; ?>
        </main>

        <footer class="grid-x">
            <?php require 'footer.php'; ?>
        </footer>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation-essential/6.2.2/js/vendor/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation-essential/6.2.2/js/vendor/what-input.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.0-rc.2/dist/js/foundation.min.js"></script>
        <script>
            //Activer le menu responsive
            $("#menu-toggle").click(function(){
                $(this).toggleClass("open");
                $(".main-nav").toggleClass("show-menu");
            });
        </script>

        <script src="public/js/script.js"></script>
        <script src="public/js/alerts.js"></script>
        <script src="public/js/modals.js"></script>
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector: "#post-content"
        });


        //vérifier si notifyTrial existe, si oui, alors on le cache
        let interTiny = setInterval(() => {
            const notifyTrial = document.getElementById("mceu_31"); // message de notification pour utiliser la version trial de TinyMCE
            if(notifyTrial !== null) {
                notifyTrial.style.display = "none";
                clearInterval(interTiny);
            }
        }, 500);
    </script>
    <script src="public/js/FetchForms.js"></script>
    </body>
</html>