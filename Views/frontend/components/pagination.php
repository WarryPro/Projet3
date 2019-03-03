<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 26/02/2019
 * Time: 00:26
 */

?>

<nav class="nav-pagination" aria-label="Pagination">
    <ul class="pagination text-center">
        <?php

            $page = intval($result[2]);

            $totalPages = intval($result[0]);

            $action = (isset($_GET['action'])) ? filter_var( $_GET['action'], FILTER_SANITIZE_STRING) : NULL;


        //$uri = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        if($page === 1) {
                echo '<li class="pagination__item pagination-previous disabled"></li>';
            }
            else {
                if(isset($action)) {
                    if($action === 'billets') {?>
                        <li class="pagination__item pagination-previous">
                            <a href="./index.php?action=billets&page=<?=$page - 1?>" class="pagination__link"></a>
                        </li>
                    <?php
                    }
                    elseif ($action === 'admin') {?>
                        <li class="pagination__item pagination-previous">
                            <a href="./index.php?action=admin&page=<?=$page - 1?>" class="pagination__link"></a>
                        </li>
                    <?php
                    }
                }
            }

            for($i = 1; $i <= $totalPages; $i++) {
                if($page === $i) { ?>

                    <li class="pagination__item">
                            <a href="./index.php?action=<?php echo $action?>&page=<?=$i?>" class="pagination__link current"><?=$i?></a>
                    </li>
                <?php
                }
                else { ?>
                    <li class="pagination__item">
                        <a href="./index.php?action=<?php echo $action?>&page=<?=$i?>" class="pagination__link"><?=$i?></a>
                    </li>
                   <?php
                }
            }

        if($page === $totalPages) {
            echo '<li class="pagination__item pagination-next disabled"></li>';
        }
        else {
            if(isset($action)) {
                if($action === 'billets') {?>
                    <li class="pagination__item pagination-next">
                        <a href="./index.php?action=billets&page=<?=$page + 1?>" class="pagination__link"></a>
                    </li>
                    <?php
                }
                elseif ($action === 'admin') {?>
                    <li class="pagination__item pagination-next">
                        <a href="./index.php?action=admin&page=<?=$page + 1?>" class="pagination__link"></a>
                    </li>
                    <?php
                }
            }
        }
            ?>

    </ul>
</nav>
