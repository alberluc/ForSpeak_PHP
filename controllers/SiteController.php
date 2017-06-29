<?php
/**
 * Created by PhpStorm.
 * User: Lucien
 * Date: 11/06/2017
 * Time: 18:17
 */


class SiteController extends BaseController
{
    public function index($d = null)
    {
        $datas = array(
            "postsDescNote" => Post::GetDescNote(10),
            "postsDescDate" => Post::GetDescDate(10)
        );
        if(!is_null($d))
            $datas = array_merge($d, $datas);
        $this->render("index", $datas);
    }
}