<?php

/**
 * Created by PhpStorm.
 * User: Lucien
 * Date: 11/06/2017
 * Time: 19:28
 */
class Post
{
    private $id;
    private $user;
    private $comments;
    private $title;
    private $content;
    private $note;
    private $date;

    function __construct()
    {

    }

    private static function arrayToPost($row)
    {
        $post = new Post();
        $post->id = $row["id_post"];
        $post->title = $row["title_post"];
        $post->content = $row["content_post"];
        $post->date = DateTransform::TransformToString($row["createdAt_post"]);
        $post->user = User::GetByID($row["id_user"]);
        $post->comments = Comment::GetByPost($post->id);
        $post->note = self::GetNote($post->id);
        return $post;
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

    public static function GetAll()
    {
        $req = db()->prepare("SELECT * FROM Post");
        $req->execute();
        $posts = array();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)){
            $posts[] = self::arrayToPost($row);
        }
        return $posts;
    }

    public static function GetByID($id_post)
    {
        $req = db()->prepare("SELECT * FROM Post WHERE id_post = :id_post");
        $req->execute([":id_post" => $id_post]);
        $row = $req->fetch();
        return self::arrayToPost($row);
    }

    public static function GetByUser($id_user)
    {
        $req = db()->prepare("SELECT * FROM Post WHERE id_user = :id_user");
        if(!$req->execute([":id_user" => $id_user])){
            print_r($req->errorInfo());
            return null;
        }
        $posts = array();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)){
            $posts[] = self::arrayToPost($row);
        }
        return $posts;
    }


    private static function GetNote($id_post)
    {
        $req = db()->prepare("SELECT COALESCE(sum(n.value_note), 0) as 'note_post' FROM forspeak.post p join note n on p.id_post = n.id_post WHERE n.id_post = :id_post");
        if(!$req->execute([
            ":id_post" => $id_post
        ])){
            print_r($req->errorInfo());
        }
        if($row = $req->fetch()){
            return $row["note_post"];
        }
        return 0;
    }

    public static function GetBySearch($search_value)
    {
        $req = db()->prepare("SELECT * FROM Post P JOIN User U ON P.id_user = U.id_user WHERE title_post LIKE :search_value OR U.pseudo_user = :search_user");
        if(!$req->execute([
            ":search_user" => $search_value,
            ":search_value" => '%'.$search_value.'%'
        ])){
            print_r($req->errorInfo());
            return null;
        }
        $posts = array();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)){
            $posts[] = self::arrayToPost($row);
        }
        return $posts;
    }

    public function add($user, $title_post, $content_post)
    {
        $req = db()->prepare("INSERT INTO Post (id_user, title_post, content_post) VALUES (:id_user, :title_post, :content_post)");
        if(!$req->execute([
            ":id_user" => $user->id,
            ":title_post" => $title_post,
            ":content_post" => $content_post
        ])){
            $req->errorInfo();
        }
    }

    public static function GetDescNote($nb)
    {
        $req = db()->prepare("SELECT P.id_post, P.id_user, P.title_post, P.content_post, P.createdAt_post, COALESCE(SUM(N.value_note), 0) as 'Note' FROM Post P LEFT JOIN Note N ON P.id_post = N.id_post GROUP BY P.title_post ORDER BY Note DESC LIMIT 10");
        if(!$req->execute()){
            print_r($req->errorInfo());
        }
        $posts = array();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)){
            $posts[] = self::arrayToPost($row);
        }
        return $posts;
    }

    public static function GetDescDate($nb)
    {
        $req = db()->prepare("SELECT * FROM Post ORDER BY createdAt_post DESC LIMIT 10");
        if(!$req->execute()){
            print_r($req->errorInfo());
        }
        $posts = array();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)){
            $posts[] = self::arrayToPost($row);
        }
        return $posts;
    }

}