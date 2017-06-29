<?php
    include_once "../class/user.php";
    include_once "../database/connection.php";
    session_start();

    $infoNote = json_decode($_POST["infoNote"]);
    $user = $_SESSION["user"];

    if($infoNote->value_note < -1 || $infoNote->value_note > 1)
        return "error";

    if($note = $user->noteOnPost($infoNote->id_post) == null){
        $req = db()->prepare("INSERT INTO Note (id_post, id_user, value_note) VALUES (:id_post, :id_user, :value_note)");
        if(!$req->execute([
            ":id_post" => $infoNote->id_post,
            ":id_user" => $user->id,
            ":value_note" => $infoNote->value_note
        ])){
            $req->errorInfo();
        }
    }
    else{
        $req = db()->prepare("UPDATE Note SET value_note = :value_note WHERE id_post = :id_post AND id_user = :id_user");
        if(!$req->execute([
            ":id_post" => $infoNote->id_post,
            ":id_user" => $user->id,
            ":value_note" => $infoNote->value_note
        ])){
            $req->errorInfo();
        }
    }

    $req = db()->prepare("SELECT sum(value_note) as 'sum_note' FROM Note WHERE id_post = :id_post GROUP BY value_note");
    if(!$req->execute([
        ":id_post" => $infoNote->id_post
    ])){
        $req->errorInfo();
    }
    if($row = $req->fetch()){
        echo $row["sum_note"];
    }
    else{
        echo 0;
    }
