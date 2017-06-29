<div class="page-top">
    <h3><?= count($datas["posts"]) ?> résultat(s) pour la recherche '<span class="post-info"><?= $datas["key_search"] ?></span>'</h3>
</div>
<div class="main">
    <?php foreach ($datas["posts"] as $post): ?>
        <div class="post">
            <div class="post-left">
                <h3><?= $post->title ?></h3>
                <p><i>Posté par <span class="post-info"><?= $post->user->pseudo ?></span> le <span class="post-info"><?= $post->date ?></span></i></p>
                <p><?= substr($post->content, 0, 160).'...' ?></p>
            </div>
            <div class="post-right">
                <span class="post-note"><?= $post->note ?> | <i class="fa fa-star" aria-hidden="true"></i></span>
                <a href=".?r=post/view&id_post=<?= $post->id ?>" class="post-link">Voir le post</a>
            </div>
        </div>
        <div class="post-separator"></div>
    <?php endforeach; ?>
</div>