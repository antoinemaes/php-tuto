<?php 
try
{
	$db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'antoine', 'sqvmf72w');
}
catch (Exception $e)
{
    die('Error : ' . $e->getMessage());
}

if(isset($_GET['article_id']) and isset($_POST['name']) and isset($_POST['comment'])) {
    if(strlen($_POST['name']) <= 50) {
        $req = $db->prepare('INSERT INTO Comment (author, content, article_id) VALUES (?, ?, ?)');
        $req->execute(array($_POST['name'], $_POST['comment'], $_GET['article_id']));
    }
    header('Location: comments.php?article_id='.$_GET['article_id']);
} else {
    echo 'Error';
}

?>
