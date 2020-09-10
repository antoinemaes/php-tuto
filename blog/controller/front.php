<?php
require('model/data_access.php');

function showArticles() {
    $page=isset($_GET['page']) ? $_GET['page'] : 1;
    $count=getArticleCount();
    $articles=getLastArticles($page);
    require('view/showArticles.php');
}

function showComments() {
    if(isset($_GET['article_id'])) {
        $article_id=$_GET['article_id'];
        $article=getArticleById($article_id);
        $comments=getCommentsFromArticle($article_id);
        require('view/showComments.php');
    } else {
        echo '<p>Error : missing parameter article_id.</p>';
    }
}

function postComment() {
    if(isset($_GET['article_id']) and isset($_POST['name']) and isset($_POST['comment'])) {
        putComment($_POST['name'], $_POST['comment'], $_GET['article_id']);
        header('Location: index.php?action=showComments&article_id='.$_GET['article_id']);
    } else {
        echo 'Error : missing parameter.';
    }
}
