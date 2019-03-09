
<div class="post-aside small-12 medium-4 large-3">

    <div class="post-header">

        <div class="post-header-blog">
            <div class="btn-menu">
                <?php require('components/btn-hamburger.php'); ?>
            </div>
            <div class="container-title">
                <a href="./index.php" class="main-header__title">Jean Forteroche Blog!</a>
            </div>
        </div>

        <div class="container-post-menu grid-x small-12">
            <nav class="main-nav">
                <ul class="post-menu menu vertical">
                    <li class="main-menu__item">
                        <a href="./index.php" class="main-menu__link">Accueil</a>
                    </li>
                    <li class="main-menu__item">
                        <a href="./index.php?action=billets" class="main-menu__link">Billets</a>
                    </li>

                    <?php
                    $sessionController = New \Controllers\SessionController();
                    $currentUser = $sessionController -> getCurrentUser();
                    $userRole = $sessionController -> getSessionRole();

                    if(!isset($currentUser) && !isset($userRole) ) {

                        echo(' <li class="main-menu__item">
                        <a href="./index.php?action=contact" class="main-menu__link">Contact</a>
                    </li>
                    <li class="main-menu__item">
                        <a href="./index.php?action=connexion" class="main-menu__link">Se connecter</a>
                    </li>
                    <li class="main-menu__item">
                        <a href="./index.php?action=inscription" class="main-menu__link">S\'inscrire</a>
                    </li>');
                    }
                    elseif (isset($currentUser) && $userRole === 'Admin') {
                        echo('<li class="main-menu__item">
                                 <a href="./index.php?action=profil" class="main-menu__link">Profil</a>
                              </li>
                              <li class="main-menu__item">
                                 <a href="./index.php?action=admin" class="main-menu__link">Admin</a>
                              </li>
                              <li class="main-menu__item">
                                 <a href="./index.php?action=deconnexion" class="main-menu__link">Se deconnecter</a>
                              </li>'
                        );
                    }
                    else {
                        echo('<li class="main-menu__item">
                                 <a href="./index.php?action=profil" class="main-menu__link">Profil</a>
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

    <div class="container-titre-livre">
        <p class="auteur">Jean Forteroche</p>
        <h1 class="titre-livre">BILLET SIMPLE POUR L'ALASKA</h1>
    </div>

</div>


