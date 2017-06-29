<?php

/**
 * Created by PhpStorm.
 * User: Lucien
 * Date: 11/06/2017
 * Time: 23:17
 */
class PostController extends BaseController
{

    /**
     * PostController constructor.
     */
    public function __construct()
    {
    }

    public function view()
    {
        $datas = array(
            "post" => Post::GetByID(parameters()["id_post"])
        );
        $this->render("view", $datas);
    }

    public function add()
    {
        if(isset(parameters()["commit"])){
            $post = new Post();
            $post->add(
                $_SESSION["user"],
                parameters()["title_post"],
                parameters()["content_post"]
            );
            $site = new SiteController();
            $site->index();
        }
        else
            $this->render("add");
    }

    public function search()
    {
        $datas = array(
            "key_search" => parameters()["search_value"],
            "posts" => Post::GetBySearch(parameters()["search_value"])
        );
        $this->render("search", $datas);
    }

}