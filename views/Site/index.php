<div class="index-top">
    <h3>Bonjour et bienvue sur ForSpeak, site de forum</h3>
    <div class="index-menu">
        <a id="most-recent" class="home-post-link active"><i class="fa fa-clock-o" aria-hidden="true"></i>Les plus récents</a>
        <a id="top-value" class="home-post-link"><i class="fa fa-star" aria-hidden="true"></i> Les mieux notés</a>
    </div>
</div>
<div class="main">
    <div class="index-page">
        <div id="most-recent" class="home-post-block">
            <h3>Les plus récents...</h3>
            <?php foreach ($datas["postsDescDate"] as $post): ?>
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
        <div id="top-value" class="home-post-block">
            <h3>Les mieux notés...</h3>
            <?php foreach ($datas["postsDescNote"] as $post): ?>
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
    </div>
</div>