<div class="page-top">
<?php

    if($datas["user"]->id == $_SESSION["user"]->id){

        ?>

        <h1>Mon compte</h1>
        <h3><?= $datas["user"]->pseudo ?></h3>

        <?php

    }
    else{

        ?>

        <h1><?= $datas["user"]->pseudo ?></h1>

        <?php

    }

?>
</div>
<div class="main">
    <h3>Liste des posts :</h3>
    <?php foreach($datas["posts"] as $post): ?>
        <p><a href="?r=post/view&id_post=<?= $post->id ?>"><?= $post->title ?></a></p>
    <?php endforeach; ?>
</div>
