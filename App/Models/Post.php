<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Post extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM post');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function newPost($userId,$title,$content){
        $actualDay = date("Y/m/d");
        $db = static::getDB();
        $stmt = $db->prepare('INSERT INTO post(user_id,titulo,contenido) VALUES(?,?,?)');
        $stmt->bindParam(1,$userId);
        $stmt->bindParam(2,$title);
        $stmt->bindParam(3,$content);
        return $stmt->execute();
    }
}