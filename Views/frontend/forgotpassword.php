<?php $title = 'connection';?>

<?php ob_start(); ?>

    <div class="grid-container">

        <div class="form-container">

            <form action="index.php?action=forgotpassword" method="POST" class="form">
                <p class="form-group">Veuillez saisir votre email</p>

                <div class="grid-x">
                    <div class="form-group">

                        <div class="small-12 medium-4">
                            <input type="email" name="email" id="email" class="email form-control" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-valider" value="valider"></input>
                </div>
            </form>
        </div>
    </div>


<?php $content = ob_get_clean();?>

<?php require ('template.php');?>