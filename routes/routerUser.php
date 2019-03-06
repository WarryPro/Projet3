<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 05/02/2019
 * Time: 23:45
 */

if(empty($_POST['user']) || empty($_POST['email'])) {
    echo json_encode('llena los campos');
}
else {
    echo json_encode('correcto' . $_POST['email'] . ' user ' . $_POST['user']);
}
