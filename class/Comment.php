<?php

/**
 * Created by PhpStorm.
 * User: Lucien
 * Date: 11/06/2017
 * Time: 19:29
 */
class Comment
{
    private $id;
    private $content;
    private $user;

    function __construct()
    {

    }

    function __get($name)
    {
        if(property_exists(__CLASS__ ,$name))
            return $this->$name;
        else
            throw new InvalidArgumentException("La propriété ".$name." n'existe pas!");
    }

    function __set($name, $value)
    {
        if(property_exists(__CLASS__, $name))
            $this->$name = $value;
        else
            throw new InvalidArgumentException("La propriété ".$name." n'existe pas!");
    }

    public static function GetByPost($id_post)
    {
        $req = db()->prepare("SELECT * FROM Comment WHERE id_post = :id_post");
        $req->execute([":id_post" => $id_post]);
        $comments = array();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)){
            $comment = new Comment();
            $comment->id = $row['id_comment'];
            $comment->content = $row['content_comment'];
            $comment->user = User::GetByID($row["id_user"]);
            $comments[$comment->id] = $comment;
        }
        return $comments;
    }

    public function add($id_post,User $user, $content_comment)
    {
        $req = db()->prepare("INSERT INTO Comment (id_post, id_user, content_comment) VALUES (:id_post, :id_user, :content_comment)");
        if (!$req->execute([
            ":id_post" => $id_post,
            ":id_user" => $user->id,
            ":content_comment" => $content_comment,
        ])
        ) {
            print_r($req->errorInfo());
        }
    }

    private function valid_value_comment($value)
    {
        if(in_array($value, range(-1, 1)))
            return true;
        else
            throw new Exception("La note ".$value." n'est pas valide !");
    }

    public function delete($id_post, $id_comment)
    {
        if(self::valid_comment_user($id_post, $id_comment)){
            $req = db()->prepare("DELETE FROM Comment WHERE id_comment = :id_comment");
            $req->execute([
                ":id_comment" => $id_comment
            ]);
        }
    }

    private static function valid_comment_user($id_post, $id_comment)
    {
        $req = db()->prepare("SELECT * FROM Comment WHERE id_comment = :id_comment AND id_post = :id_post");
        $req->execute([
            ":id_comment" => $id_comment,
            ":id_post" => $id_post
        ]);
        if($row = $req->fetch()){
            return true;
        }
        return false;
    }

}