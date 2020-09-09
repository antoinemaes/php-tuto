<!DOCTYPE HTML>

<head>
    <title>My blog</title>
    <meta charset='utf-8'>
</head>

<body>

    <main>
        <h1>Welcome to my blog</h1>
        
        <?php
        
        if(isset($_GET['article_id'])) {
        
            try {
                $pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'antoine', 'sqvmf72w');
            }
            catch (Exception $e) {
                die('Error : ' . $e->getMessage());
            }
            
            $request=$pdo->prepare("SELECT id, title, DATE_FORMAT(date, '%M %D, %Y at %l:%i%p') as date_string, content FROM Article WHERE id=? ORDER BY date");
            $request->execute(array($_GET['article_id']));
            
            if($request) {
            
                $line=$request->fetch();
                ?>
                <div class='article'>
                    <h2><?php echo htmlspecialchars($line['title']);?></h2>
                    <h3><?php echo htmlspecialchars($line['date_string']);?></h3>
                    <p><?php echo htmlspecialchars($line['content']);?></p>
                </div>
                <?php
                
                $request=$pdo->prepare("SELECT author, DATE_FORMAT(date, '%M %D, %Y at %l:%i%p') as date_string, content FROM Comment WHERE article_id=?");
                $request->execute(array($_GET['article_id']));
                
                ?>
                <div class='comment-section'>
                    <h2>Comments</h2>
                    <?php
                    while($line=$request->fetch()) {
                        ?>
                        <div class='comment'>
                            <p><strong><?php echo $line['author'];?></strong>, <?php echo $line['date_string'];?></p>
                            <p><?php echo $line['content'];?></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php
            } else {
            
                ?>
                <p>Error : article not found.</p>
                <?php
            
            }
        
        } else {
    
            ?>
            <p>Error : missing parameter article_id.</p>
            <?php
            
        }
           
        ?>
        
    </main>
    
    <footer>
        <a href='articles.php'>Back to articles</a>
    </footer>
        
