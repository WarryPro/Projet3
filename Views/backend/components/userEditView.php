<?php $title = 'Editer utilisateur'; ?>


<div id="modal" class="container-login container-user-edit hide">
    <?php
    $data = listUsers();
    foreach ($data as $user) {
        print_r('
            <div class="main-container-form card">
                <div id="btn-close" class="btn-close"></div>
                <div class="container-photo-profile">
                    <div class="photo-profile" style="background-image: url('. './public/images/' . $user['user'] . '.jpg'.');">
                    </div>
                    <p class="text-connexion">Editer utilisateur</p>
                </div>       
                <div class="container-form grid-x">
                    <form action="index.php?action=editeruser" method="POST" class="small-10">
                        <div class="form-group">
                            <span class="fas fa-user icon-user"></span>
                            <input type="text" name="user" id="user" placeholder="Utilisater" value="'. $user['user'] .'" required>
                        </div>
            
                        <div class="form-group">
                            <span class="fas fa-lock icon-password"></span>
                            <input type="password" name="current-pass" id="current-pass" required placeholder="Actuel mot de passe">
                        </div>
                        
                        <div class="form-group">
                            <span class="fas fa-lock icon-password"></span>
                            <input type="password" name="new-pass" id="new-pass" required placeholder="Nouveau mot de passe">
                        </div>
                        
                        <div class="form-group radio">');
                            if(isset($user['user_role']) && $user['user_role'] !== 'Admin') {
                              print_r('<input class="radio-form" id="user-user" type="radio" name="user_role" value="User" checked>
                              <label class="label-form" for="user-user">User</label>
                                
                              <input class="radio-form" id="user-admin" type="radio" name="user_role" value="Admin">
                              <label class="label-form" for="user-admin">Admin</label>');
                            }
                            else {
                                print_r('<input class="radio-form user-radio" id="user-user" type="radio" name="user_role" value="User">
                              <label class="label-form " for="user-radio">User</label>
                                
                              <input class="radio-form admin-radio" id="user-admin" type="radio" name="user_role" value="Admin" checked>
                              <label class="label-form" for="admin-radio">Admin</label>');
                            }

                    print_r('</div>
                        <div class="form-group group-valider">
                            <input class="btn-valider" type="submit" name="update" value="Mettre à jour">
                        </div>
                    </form>
                </div>
            </div>');

    }
    ?>
</div>

