<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 19/02/2019
 * Time: 23:02
 */

?>

<div class="small-12 grid-x pd-top-btm">
    <table class="stack table-scroll">
        <thead>
            <tr>
                <th>Épisode</th>
                <th>Date</th>
                <th>ID épisode</th>
                <th>Commentaire</th>
                <th>signaleurs</th>
                <th>Total fois signalé</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $reportedComments = listReportedComments();

            foreach($reportedComments as $comment) {
                echo('
                        <tr>
                            <td><a class="btn--alt valider--alt" href="./index.php?action=post&id='. $comment["episode_id"] .'">Voir l\'épisode</a></td>
                            <td>' . $comment["date_fr"] . '</td>
                            <td>' . $comment["episode_id"] . '</td>
                            <td>' . $comment["reported_comment"] . '</td>
                            <td>' . $comment["users_accusers"] . '</td>
                            <td>' . $comment["total_reports"] . '</td>
                            <td class="action-bouttons">
                                <a class="btn--alt error--alt" href="index.php?action=supreportedcom&id='. $comment['comment_id'].'">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <a class="btn--alt valider" href="index.php?action=validatecomment&id='. $comment['comment_id'] .'">
                                    <i class="fas fa-check"></i>
                                </a>
                            </td>
                        </tr>
                ');
        }
        $reportedComments -> closeCursor();
    ?>
        </tbody>
    </table>
</div>