<?php
require('model/data_access.php');
require('autoload.php');

function showArticles() {
    $mgr = new PDOArticleManager();
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $count = $mgr->getArticleCount();
    $articles = $mgr->getLastArticles($page);
    require('view/showArticles.php');
}

function showComments() {
    $mgr = new PDOArticleManager();
    if(isset($_GET['article_id'])) {
        $article_id=$_GET['article_id'];
        $article=$mgr->getArticleById($article_id);
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
