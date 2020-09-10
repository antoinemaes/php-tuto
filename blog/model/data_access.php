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

function getArticles($page=1, $limit=5) {
    global $pdo;
    $request=$pdo->prepare("SELECT id, title, DATE_FORMAT(date, '%M %D, %Y at %l:%i%p') as date_string, content FROM Article ORDER BY date DESC LIMIT ?, ?");
    $request->bindValue(1, $limit*($page-1), PDO::PARAM_INT);
    $request->bindValue(2, $limit, PDO::PARAM_INT);
    $request->execute();
    return $request;
}
