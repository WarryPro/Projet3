<?php

namespace Models;


class Manager {
    
    public static function dbConnect() {
    
            $bdd = new \PDO(
                'mysql:host=localhost; dbname=blog; charset=utf8',
                'root',
                '',
                [ \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION ]);
    
        return $bdd;
    }
}