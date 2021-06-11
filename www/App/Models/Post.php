<?php


namespace App\Models;

use PDO;
use Redis;


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
        $redis = new Redis();
        $redis->connect('redis_cache',6379);
        
        $sql = "SELECT * FROM post";

        $cache_key = md5($sql);
        
        $data = [];

        if($redis->exists($cache_key)){
            $data_source = "Data posts redis";
            $data = unserialize($redis->get($cache_key));
        }else{

            $data_source = "Data posts redis";
            $db = static::getDB();
            $stmt = $db->query($sql);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {          
               $data[] = $row;  
            }  
            $redis->set($cache_key, serialize($data));
            $redis->expire($cache_key,10);
            //return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }

        return $data;
        
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