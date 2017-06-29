<?php

/**
 * Created by PhpStorm.
 * User: Lucien
 * Date: 11/06/2017
 * Time: 18:53
 */
class User
{
    private $id;
    private $pseudo;
    private $mail;
    private $password;
    private $registedAt;

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

    public static function GetAll()
    {
        $req = db()->prepare("SELECT * FROM User");
        $req->execute();
        $users = array();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)){
            $user = new User();
            $user->id = $row['id_user'];
            $user->pseudo = $row['pseudo_user'];
            $user->mail = $row['mail_user'];
            $user->password = $row['password_user'];
            $users[$user->id] = $user;
        }
        return $users;
    }

    public static function GetByID($id_user)
    {
        $req = db()->prepare("SELECT * FROM User WHERE id_user = :id_user");
        $req->execute([":id_user" => $id_user]);
        $user = new User();
        $row = $req->fetch();
        $user->id = $row['id_user'];
        $user->pseudo = $row['pseudo_user'];
        $user->mail = $row['mail_user'];
        $user->password = $row['password_user'];
        return $user;
    }

    public static function user_exist()
    {
        $req = db()->prepare("SELECT * FROM User WHERE mail_user = :mail_user OR pseudo_user = :pseudo_user");
        $req->execute([
            ":mail_user" => parameters()["mail_user"],
            ":pseudo_user" => parameters()["pseudo_user"]
        ]);
        if($req->fetch())
            return true;
        return false;
    }

    public static function create_user($mail_user, $pseudo_user, $password_user)
    {
        $req = db()->prepare("INSERT INTO User (mail_user, pseudo_user, password_user) VALUES (:mail_user, :pseudo_user, :password_user)");
        $req->execute([
           ":mail_user" => $mail_user,
           ":pseudo_user" => $pseudo_user,
           ":password_user" => $password_user,
        ]);
        $user = new User();
        $user->id = db()->lastInsertId();
        $user->mail = $mail_user;
        $user->pseudo = $pseudo_user;
        $user->password = $password_user;
        var_dump($user);
        return $user;
    }

    public static function valid_user($identifiant_user, $password_user)
    {
        $req = db()->prepare("SELECT * FROM User WHERE (pseudo_user = :identifiant_user OR mail_user = :identifiant_user) AND password_user = :password_user");
        if(!$req->execute([
            ":identifiant_user" => $identifiant_user,
            ":password_user" => $password_user
        ])){
            print_r($req->errorInfo());
            return null;
        }
        if($row = $req->fetch()){
            $user = new User();
            $user->id = $row['id_user'];
            $user->pseudo = $row['pseudo_user'];
            $user->mail = $row['mail_user'];
            $user->password = $row['password_user'];
            return $user;
        }
        return null;
    }

    public function connect()
    {
        $_SESSION["connected"] = true;
        $_SESSION["user"] = $this;
    }

    public function noteOnPost($post_id)
    {
        $req = db()->prepare("SELECT * FROM user u join post p on u.id_user = p.id_post join note n on n.id_post = p.id_post where n.id_user = :id_user AND p.id_post = :id_post");
        if(!$req->execute([
            "id_user" => $this->id,
            "id_post" => $post_id
        ])){
            print_r($req->errorInfo());
        }
        if($row = $req->fetch()){
            return $row["value_note"];
        }
        return null;
    }

}