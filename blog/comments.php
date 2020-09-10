<?php

require('model/data_access.php');

if(isset($_GET['article_id'])) {
    $article_id=$_GET['article_id'];
    $article=getArticleById($article_id);
    $comments=getCommentsFromArticle($article_id);
    require('view/comments.php');
} else {
    echo '<p>Error : missing parameter article_id.</p>';
}

