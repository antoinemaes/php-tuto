<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'antoine', 'sqvmf72w');
}
catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

function getCommentsFromArticle($article_id) {
    global $pdo;
    $request=$pdo->prepare("SELECT author, DATE_FORMAT(date, '%M %D, %Y at %l:%i%p') as date_string, content FROM Comment WHERE article_id=?");
    $request->execute(array($article_id));
    return $request;
}

function putComment($author, $comment, $article_id) {
    global $pdo;
    $req = $pdo->prepare('INSERT INTO Comment (author, content, article_id) VALUES (?, ?, ?)');
    $req->execute(array($author, $comment, $article_id));
}
