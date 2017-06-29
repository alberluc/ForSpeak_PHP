<?php

/**
 * Created by PhpStorm.
 * User: Lucien
 * Date: 17/06/2017
 * Time: 18:40
 */
class CommentController extends BaseController
{

    public function add()
    {
        $comment = new Comment();
        try{
            $comment->add(
                parameters()["id_post"],
                $_SESSION["user"],
                parameters()["content_comment"]
            );
            $post = new PostController();
            $post->view();
        }
        catch(Exception $e){ var_dump("Erreur : " . $e->getMessage()); }
    }

    public  function delete()
    {
        $comment = new Comment();
        $comment->delete(parameters()["id_post"], parameters()["id_comment"]);
        $post = new  PostController();
        $post->view();
    }

}