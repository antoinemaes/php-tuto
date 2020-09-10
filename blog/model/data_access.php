<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'antoine', 'sqvmf72w');
}
catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}
        
function getArticleCount() { 
    global $pdo;     
    $response=$pdo->query('SELECT COUNT(*) FROM Article') or die(print_r($pdo->errorInfo()));
    $line = $response->fetch();
    return $line[0];
}

function getLastArticles($page=1, $limit=5) {
    global $pdo;
    $request=$pdo->prepare("SELECT id, title, DATE_FORMAT(date, '%M %D, %Y at %l:%i%p') as date_string, content FROM Article ORDER BY date DESC LIMIT ?, ?");
    $request->bindValue(1, $limit*($page-1), PDO::PARAM_INT);
    $request->bindValue(2, $limit, PDO::PARAM_INT);
    $request->execute();
    return $request;
}

function getArticleById($id) {
    global $pdo;
    $request=$pdo->prepare("SELECT id, title, DATE_FORMAT(date, '%M %D, %Y at %l:%i%p') as date_string, content FROM Article WHERE id=?");
    $request->execute(array($id));
    if($request)
        return $request->fetch();
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
