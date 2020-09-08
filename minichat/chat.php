<?php 
try
{
	$db = new PDO('mysql:host=localhost;dbname=chat;charset=utf8', 'antoine', 'sqvmf72w');
}
catch (Exception $e)
{
    die('Error : ' . $e->getMessage());
}
?>

<!DOCTYPE HTML>

<head>
    <title>Mini-chat</title>
    <meta charset="utf-8" />
</head>

<body>

    <div>
    
        <form action='chat_post.php' method='POST'> 
            <div>
                <label for='name'>Name</label>
                <input 
                    id='name' 
                    name='name' 
                    type='text' 
                    maxlength='20'
                    required
                    <?php 
                        if(isset($_COOKIE['name'])) 
                            echo 'value=\'' . $_COOKIE['name'] . '\' ';
                        else
                            echo 'autofocus';
                    ?>
                />
            </div>
            
            <div>                
                <label for='message'>Message</label>
                <input 
                    id='message' 
                    name='message' 
                    type='text' 
                    maxlength='200' 
                    required
                    autocomplete='off'
                    <?php
                        if(isset($_COOKIE['name']))
                            echo 'autofocus';
                    ?>
                /> 
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
