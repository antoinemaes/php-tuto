<?php

use Antoine\blog\model\PDOArticleManager;
use Antoine\blog\model\PDOCommentManager;

use Antoine\blog\model\Comment;
use Antoine\blog\model\Article;

function showArticles() {
    $mgr = new PDOArticleManager;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $count = $mgr->getArticleCount();
    $articles = $mgr->getLastArticles($page);
    require('view/showArticles.php');
}

function showComments() {
    $article_mgr = new PDOArticleManager;
    $comment_mgr = new PDOCommentManager;
    if(isset($_GET['article_id'])) {
        $article_id=$_GET['article_id'];
        $article=$article_mgr->getArticleById($article_id);
        $comments=$comment_mgr->getCommentsFromArticle($article_id);
        require('view/showComments.php');
    } else {
        echo '<p>Error : missing parameter article_id.</p>';
    }
}

function postComment() {
    $mgr = new PDOCommentManager;
    if(isset($_GET['article_id'])
      and isset($_POST['name'])
      and isset($_POST['comment'])) {
        $comment = new Comment;
        $comment->setArticleId($_GET['article_id']);
        $comment->setAuthor($_POST['name']);
        $comment->setContent($_POST['comment']);
        $mgr->putComment($comment);
        header('Location: index.php?'
          .'action=showComments&article_id='.$_GET['article_id']);
    } else {
        echo 'Error : missing parameter.';
    }
}
