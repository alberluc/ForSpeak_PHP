<?php

/**
 * Created by PhpStorm.
 * User: Lucien
 * Date: 12/06/2017
 * Time: 18:44
 */
class UserController extends BaseController
{

    /**
     * UserController constructor.
     */
    public function __construct()
    {
    }

    public function register()
    {
        if(User::user_exist()){
            $datas = array(
                "errors" => array(
                    "Le pseudo ou l'email existe déjà !"
                )
            );
        }
        else{
            $user = User::create_user(
                parameters()["mail"],
                parameters()["pseudo"],
                parameters()["password"]
            );
            $user->connect();
            $datas = array(
                "success" => array(
                    "Vous etes connecté !"
                )
            );
        }
        $site = new SiteController();
        $site->index($datas);
    }

    public function login()
    {
        $user = User::valid_user(
            parameters()["identifiant_user"],
            parameters()["password_user"]
        );
        if($user != null){
            $datas = array(
                "success" => array(
                    "Vous etes connecté !"
                )
            );
            $user->connect();
        }
        else{
            $datas = array(
                "errors" => array(
                    "Identifiants invalides !"
                )
            );
        }
        $site = new SiteController();
        $site->index($datas);
    }

    public function disconnect()
    {
        session_destroy();
        $this->redirect(".");
    }

    public function view()
    {
        $datas = array(
          "user" => User::GetByID(parameters()["id_user"]),
          "posts" => Post::GetByUser(parameters()["id_user"])
        );
        $this->render("view", $datas);
    }

}