<div class="page-top">
    <h3>Ajouter un post</h3>
</div>
<div class="main">
    <form action="?r=post/add" method="post">
        <p><label for="title_post">Titre :</label></p>
        <p><input type="text" name="title_post" id="title_post"></p>
        <p><label for="content_post">Message :</label></p>
        <p><textarea name="content_post" id="content_post"></textarea></p>
        <p><input type="submit" name="commit" value="Valider"></p>
    </form>
</div>
<?php
