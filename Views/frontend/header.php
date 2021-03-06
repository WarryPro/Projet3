<div class="grid-container header grid-x">
    <div class="small-12 grid-x container-title">

        <?php require 'components/btn-hamburger.php'; ?>

        <h1 class="main-header__title">Jean Forteroche Blog</h1>

        <?php
            require 'components/menuReseauxSociaux.php';
        ?>
    </div>
        <div class="container-main-menu grid-x small-12">
            <nav id="exemple-menu" class="main-nav">
                <ul class="vertical large-horizontal main-menu menu">
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

                        echo('<li class="main-menu__item">
                                                <a href="./index.php?action=connexion" class="main-menu__link">Se connecter</a>
                                            </li>
                                            
                                            <li class="main-menu__item">
                                                <a href="./index.php?action=inscription" class="main-menu__link">S\'inscrire</a>
                                            </li>'
                        );

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