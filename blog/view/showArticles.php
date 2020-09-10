<!DOCTYPE HTML>

<head>
    <title>My blog</title>
    <meta charset='utf-8'>
</head>

<body>

    <main>
        <h1>Welcome to my blog</h1>
        
        <?php        
        while($line = $articles->fetch()) {
            ?>
            <div class='article'>
                <h2><?= htmlspecialchars($line['title'])?></h2>
                <h3><?= htmlspecialchars($line['date_string'])?></h3>
                <p><?= nl2br(htmlspecialchars($line['content']))?></p>
                <a href=<?= '"index.php?action=showComments&article_id='.$line['id'].'"'?>>Comments</a>
            </div>
            <?php
        }
        $articles->closeCursor();
        ?>
    </main>
    
    <footer>
        <?php
        for($i=1;$i<=$count/5+1;$i++)
            echo '<a href="index.php?action=showArticles&page=' . $i . '">' . $i . '</a> ';
        ?>
    </footer>

</body>
