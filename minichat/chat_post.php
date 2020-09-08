<?php 
try
{
	$db = new PDO('mysql:host=localhost;dbname=chat;charset=utf8', 'antoine', 'sqvmf72w');
}
catch (Exception $e)
{
    die('Error : ' . $e->getMessage());
}

if(isset($_POST['name']) and isset($_POST['message'])) {
    if(strlen($_POST['name']) <= 50) {
        $req = $db->prepare('INSERT INTO Messages (name, message) VALUES (?, ?)');
        $req->execute(array($_POST['name'], $_POST['message']));
    }
    setcookie('name', $_POST['name']);
}

header('Location: chat.php');
?>
