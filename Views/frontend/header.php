<div class="grid-container header grid-x">
    <div class="small-12 grid-x container-title">
        <h1 class="main-header__title">Jean Forteroche Blog!</h1>

        <?php
            require('partials/menuReseauxSociaux.php');
        ?>
    </div>
        <div class="container-main-menu grid-x small-12">
            <nav class="main-nav">
                <ul class="main-menu menu align-right">
                    <li class="main-menu__item">
                        <a href="./index.php" class="main-menu__link">Accueil</a>
                    </li>
                    <li class="main-menu__item">
                        <a href="./index.php?action=billets" class="main-menu__link">Billets</a>
                    </li>
                    <li class="main-menu__item">
                        <a href="./index.php?action=contact" class="main-menu__link">Contact</a>
                    </li>

                    <?php
                    if(!isset($_SESSION['user'])) {

                        print_r('<li class="main-menu__item">
                                                <a href="./index.php?action=connexion" class="main-menu__link">Se connecter</a>
                                            </li>
                                            
                                            <li class="main-menu__item">
                                                <a href="./index.php?action=inscription" class="main-menu__link">S\'inscrire</a>
                                            </li>'
                        );

                    }
                    else {
                        print_r('<li class="main-menu__item">
                                                <a href="./index.php?action=admin" class="main-menu__link">Profil</a>
                                            </li>
                                            <li class="main-menu__item">
                                                <a href="./index.php?action=deconnexion" class="main-menu__link">Se deconnecter</a>
                                            </li>'
                        );
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>