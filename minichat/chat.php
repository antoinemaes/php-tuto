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
}
?>

<!DOCTYPE HTML>

<head>
    <title>Mini-chat</title>
    <meta charset="utf-8" />
</head>

<body>

    <div>
        <form action='chat.php' method='POST'>
            <div>
                <label for='name'>Name</label>
                <input id='name' name='name' type='text' <?php if(isset($_POST['name'])) echo 'value=\'' . $_POST['name'] . '\' '; ?>/>
            </div>
            <div>                
                <label for='message'>Message</label>
                <input id='message' name='message' type='text' /> 
            </div>
            <input type='submit' value='Submit' />
        </form>
    </div>

    <div>
        <?php
        $response=$db->query('SELECT name, message FROM Messages ORDER BY id DESC LIMIT 10') or die(print_r($db->errorInfo()));
        
        while($line = $response->fetch()) {
        ?>
            <p><strong><?php echo htmlspecialchars($line['name']);?></strong> : <?php echo htmlspecialchars($line['message']);?></p> 
        <?php
        }

        $response->closeCursor();
        ?>
    </div>

</body>
