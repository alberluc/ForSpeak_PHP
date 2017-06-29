<div class="page-top">
    <h1><?= $datas["post"]->title ?></h1>
    <h3>Par <span class="post-info"><?= $datas["post"]->user->pseudo ?></span></h3>
</div>
<div class="main">
    <div class="post-view">
        <p><span id="post_note"><?= $datas["post"]->note ?></span> | <i class="fa fa-star" aria-hidden="true"></i></p>
        <h3>Description de l'article :</h3>
        <p class="post-content"><?= $datas["post"]->content ?></p>

        <?php if(isset($_SESSION["connected"])): ?>

            <form class="form-comment" method="post" action="?r=comment/add">
                <h3 for="content_comment">Ecrire un commentaire :</h3>
                <p><textarea id="content_comment" name="content_comment" placeholder="Votre message..."></textarea></p>
                <input type="hidden" name="id_post" value="<?= $datas["post"]->id; ?>">
                <p><input type="submit" name="" value="Valider"></p>
            </form>
            <div class="post-note-form">
                <label for="n-unlike"><img src="../../public/img/grad/unlike.png"></label>
                <input type="radio" id="n-unlike" name="value_note" value="-1" <?php if(($note = $_SESSION['user']->noteOnPost($datas["post"]->id)) == -1) echo "checked" ?>>
                <label for="n-null"><img src="../../public/img/grad/null.png"></label>
                <input type="radio" id="n-null" name="value_note" value="0" <?php if(($note = $_SESSION['user']->noteOnPost($datas["post"]->id)) == 0) echo "checked" ?>>
                <label for="n-like"><img src="../../public/img/grad/like.png"></label>
                <input type="radio" id="n-like" name="value_note" value="1" <?php if(($note = $_SESSION['user']->noteOnPost($datas["post"]->id)) == 1) echo "checked" ?>>
            </div>

        <?php endif; ?>

        <p><?= count($datas["post"]->comments) ?> commentaire(s)</p>

        <?php foreach ($datas["post"]->comments as $comment): ?>
            <div class="comment">
                <div class="comment-header">
                <?php if(isset($_SESSION["user"]))
                    if($_SESSION["user"]->id == $comment->user->id): ?>
                        <div class="flex-comment">
                            <p><span class="comment-user"><?= $comment->user->pseudo ?></span> dit :</p>
                            <a href="?r=comment/delete&id_post=<?= $datas["post"]->id ?>&id_comment=<?= $comment->id ?>">Supprimer</a>
                        </div>
                        <?php else: ?>
                        <p><span class="comment-user"><?= $comment->user->pseudo ?></span> dit :</p>
                    <?php endif; ?>
                </div>
                <p><?= $comment->content ?></p>
            </div>
        <?php endforeach; ?>

    </div>
</div>

