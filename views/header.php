<?php header('Content-type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset=utf-8" />
        <title>ForSpeak</title>
        <link rel="stylesheet" href="../public/css/style.css"/>
        <link rel="stylesheet" href="../public/css/title.css"/>
        <link rel="stylesheet" href="../public/css/animate.css"/>
        <link rel="stylesheet" href="../public/css/font-awesome.min.css">
    </head>
    <body>
        <header>
            <div class="header-wrap-left">
                <div class="header-left">
                    <nav class="header-menu">
                        <a class="link-button" href="."><i class="fa fa-home" aria-hidden="true"></i>Accueil</a>
                        <?php if(isset($_SESSION["connected"])){ ?>
                            <a class="link-button" href="?r=user/view&id_user=<?= $_SESSION["user"]->id ?>"><i class="fa fa-user" aria-hidden="true"></i>Mon compte</a>
                            <a class="link-button" href="?r=post/add"><i class="fa fa-plus-square" aria-hidden="true"></i>Ajouter un post</a>
                            <a class="link-button" href="?r=user/disconnect"><i class="fa fa-sign-out" aria-hidden="true"></i>Se deconnecter</a>
                        <?php } ?>
                    </nav>
                    <div class="header-search">
                        <form action="?r=post/search" method="post">
                            <input type="text" name="search_value" placeholder="Rechercher...">
                            <button type="submit" class="btn-search"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex-align header-wrap-title">
                <h1 class="first-title">ForSpeak</h1>
            </div>
            <div class="header-bottom">
            <?php if(!isset($_SESSION["connected"])){ ?>
                <div class="btn-form-user">
                    <a class="link-button"><i class="fa fa-sign-in" aria-hidden="true"></i>Se connecter</a>
                </div>
                <div class="form-user-bar-top"></div>
                <div class="form-user">
                    <form action="?r=user/login" class="form-user-login" method="post">
                        <div class="form-ctn flex-between">
                            <div class="form-header">
                                <h3>Se connecter</h3>
                                <p>
                                    <label for="identifiant_user">Pseudo ou mail :</label>
                                    <input type="text" name="identifiant_user" id="identifiant_user">
                                </p>
                                <p>
                                    <label for="password_user">Mot de passe :</label>
                                    <input type="password" name="password_user" id="password_user">
                                </p>
                            </div>
                            <p><input type="submit" value="Valider"/></p>
                        </div>
                    </form>
                    <br>
                    <form action="?r=user/register" class="form-user-register" method="post">
                        <div class="form-ctn flex-between">
                            <div class="form-header">
                                <h3>S'inscrire</h3>
                                <p>
                                    <label for="pseudo_user">Pseudo :</label>
                                    <input type="text" name="pseudo_user" id="pseudo_user">
                                </p>
                                <p>
                                    <label for="mail_user">Mail :</label>
                                    <input type="email" name="mail_user" id="mail_user">
                                </p>
                                <p>
                                    <label for="password_user">Mot de passe :</label>
                                    <input type="password" name="password_user" id="password_user">
                                </p>
                            </div>
                            <p><input type="submit" value="Valider"/></p>
                        </div>
                    </form>
                </div>
            </div>
            <?php } ?>
            <div class="notifications">
                <?php if(isset($datas["errors"])){ ?>
                <div class="errors">
                    <?php
                        foreach ($datas["errors"] as $error){
                            echo "<p>".$error."</p>";
                        }
                    ?>
                </div>
                <?php
                    }
                    if(isset($datas["success"])){ ?>
                    <div class="success">
                        <?php
                        foreach ($datas["success"] as $succes){
                            echo "<p>".$succes."</p>";
                        }
                        ?>
                    </div>
                <?php } ?>
            </div>
        </header>
