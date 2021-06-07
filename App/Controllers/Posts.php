<?php

namespace App\Controllers;


use \Core\View;
use \App\Models\Post;
/**
 * Home controller
 *
 * PHP version 7.0
 */
class Posts extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('Posts/newPost.html');
    }

    public function save(){
       
        
        if($_POST['title'] != "" && $_POST['content'] != ""){
            $title = $_POST["title"];
            $content = $_POST["content"];

            if(Post::newPost(1,$title,$content)){
                print_r("Exito");
                header('Location: Home');
            }
            
        }else{
           
            $missingFields = [];
            foreach($_POST as $field => $value){
                
                if($field == "title" && $value == ""){
                    array_push($missingFields,$field);
                }
                if($field == "content" && $value == ""){
                    array_push($missingFields,$field);
                }
            }
            echo "<h4>No se ha proporcionado los datos correspondientes -> ".implode(",",$missingFields)."</h4>";
        }

        
    }

    public function retrivePosts(){
        print_r(Post::getAll());
    }
}