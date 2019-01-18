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
        print_r(
'<div class="user grid-x medium-6 large-4">
                <div class="user__info-container user-card grid-x small-12">
                    <div class="user__info grid-x">
                        <div class="user__photo">
                            <img src="./public/images/'.$user['user'].'.jpg" alt="Photo Dany">
                        </div>
                        
                        <div class="grid-y">
                            <h3 class="user__name">'. $user['user'] .'</h3>
                            <span class="user__rol">'. $user['user_role'] .'</span>
                        </div>
                    </div>
                    
                    <div class="user__controls small-12">
                        <a href="index.php?action=editeruser&id='. $user['id'].'" class="btn admin-crud__btn admin-crud__btn--editer"><i class="fas fa-user-edit"></i></a>
                        <a href="index.php?action=supprimeruser&id='. $user['id'].'" class="btn admin-crud__btn admin-crud__btn--supprimer"><i class="fas fa-user-times"></i></a>
                    </div>
                </div>
          </div>');
    }
    ?>
    </div>
</div>
