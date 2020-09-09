<!DOCTYPE HTML>

<head>
    <title>Mini-chat</title>
    <meta charset="utf-8" />
</head>

<body>

    <div id='message_form'>
    
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
    
    <?php
    try {
        $db = new PDO('mysql:host=localhost;dbname=chat;charset=utf8', 'antoine', 'sqvmf72w');
    }
    catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }
    
    $response=$db->query('SELECT COUNT(*) FROM Messages');
    $line = $response->fetch();
    $count = $line[0];
    ?>
    
    <div id='messages'>

        <?php
        $page=isset($_GET['page']) ? $_GET['page'] : 1;
        
        $request=$db->prepare('SELECT name, message FROM Messages ORDER BY id DESC LIMIT ?, 10');
        $request->bindValue(1, 10*($page-1), PDO::PARAM_INT);
        $request->execute();
        
        while($line = $request->fetch()) {
        ?>
            <p><strong><?php echo htmlspecialchars($line['name']);?></strong> : <?php echo htmlspecialchars($line['message']);?></p> 
        <?php
        }

        $response->closeCursor();
        ?>
        
    </div>
    
    <footer>
        <?php
        for($i=1;$i<=$count/10+1;$i++)
            echo '<a href=\'chat.php?page=' . $i . '\'>' . $i . '</a> ';
        ?>
    </footer>
    

</body>
