<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 19/02/2019
 * Time: 23:02
 */

?>

<div class="small-12 grid-x">
    <table class="hover table-scroll">
        <thead>
            <tr>
                <th>Commentaire</th>
                <th>Utilisateur signaleur</th>
                <th>ID épisode</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $reportedComments = listReportedComments();
            foreach($reportedComments as $comment) {
                print_r('
                        <tr>
                            <td>' . $comment["reported_comment"] . '</td>
                            <td>' . $comment["user_accuser"] . '</td>
                            <td>' . $comment["episode_id"] . '</td>
                        </tr>
                ');
        }
        $reportedComments -> closeCursor();
    ?>
        </tbody>
    </table>
</div>