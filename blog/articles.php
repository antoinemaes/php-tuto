<!DOCTYPE HTML>

<head>
    <title>My blog</title>
    <meta charset='utf-8'>
</head>

<body>

    <main>
        <h1>Welcome to my blog</h1>
        
        <?php
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'antoine', 'sqvmf72w');
        }
        catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        
        $response=$pdo->query('SELECT COUNT(*) FROM Article') or die(print_r($pdo->errorInfo()));
        $line = $response->fetch();
        $count = $line[0];
        
        $page=isset($_GET['page']) ? $_GET['page'] : 1;
        
        $request=$pdo->prepare("SELECT id, title, DATE_FORMAT(date, '%M %D, %Y at %l:%i%p') as date_string, content FROM Article ORDER BY date DESC LIMIT ?, 10");
        $request->bindValue(1, 10*($page-1), PDO::PARAM_INT);
        $request->execute();
        
        while($line = $request->fetch()) {
            ?>
            <div class='article'>
                <h2><?php echo htmlspecialchars($line['title']);?></h2>
                <h3><?php echo htmlspecialchars($line['date_string']);?></h3>
                <p><?php echo htmlspecialchars($line['content']);?></p>
                <a href=<?php echo '"comments.php?article_id=' . $line['id'] . '"';?>>Comments</a>
            </div>
            <?php
        }

        $response->closeCursor();
        ?>
    </main>
    
    <footer>
        <?php
        for($i=1;$i<=$count/10+1;$i++)
            echo '<a href="articles.php?page=' . $i . '">' . $i . '</a> ';
        ?>
    </footer>

</body>
