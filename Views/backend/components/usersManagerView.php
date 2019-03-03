<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 16/01/2019
 * Time: 21:52
 */
$data = listUsers();
?>

<div class="small-12 grid-x">
    <div class="user-manager-container grid-x small-12">
    <?php
    foreach ($data as $user) {
        echo(
'<div class="user grid-x medium-6 large-4">
                <div class="user__info-container user-card grid-x small-12">
                    <div class="user__info grid-x">
                        <div class="user__photo">
                            <img id="user-photo" src="./public/images/'.$user['user'].'.jpg" alt="Photo '.$user['user'].'">
                        </div>
                        
                        <div class="grid-y">
                            <h3 class="user__name">'. $user['user'] .'</h3>
                            <span class="user__email">'. $user['email'] .'</span>
                            <span class="user__rol">'. $user['user_role'] .'</span>
                        </div>
                    </div>
                    
                    <div class="user__controls small-12">
                        <a href="#modal-user-edit?userid='.$user['id'].'" class="btn btn__user--edit admin-crud__btn admin-crud__btn--editer" data-id="'.$user['id'].'">
                            <i class="fas fa-user-edit"></i>
                        </a>
                        <a href="index.php?action=supprimeruser&id='. $user['id'].'" class="btn btn__user--supprimer admin-crud__btn admin-crud__btn--supprimer">
                            <i class="fas fa-user-times"></i>
                        </a>
                    </div>
                </div>
          </div>');
    }
    $data -> closeCursor();
    ?>
    </div>
</div>

<?php
    require ('Views/backend/components/userEditView.php');
?>