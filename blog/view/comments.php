<!DOCTYPE HTML>

<head>
    <title>My blog</title>
    <meta charset='utf-8'>
</head>

<body>

    <main>
        <h1>Welcome to my blog</h1>
        
        <div class='article'>
            <h2><?= htmlspecialchars($article['title']) ?></h2>
            <h3><?= htmlspecialchars($article['date_string']) ?></h3>
            <p><?= htmlspecialchars($article['content']) ?></p>
        </div>
        
        <div id='comment-section'>
            <h2>Comments</h2>
            <?php
            while($line=$comments->fetch()) {
                ?>
                <div class='comment'>
                    <p><strong><?= $line['author'] ?></strong>, <?= $line['date_string'] ?></p>
                    <p><?= $line['content'] ?></p>
                </div>
                <?php
            }
            ?>
        </div>
        
        <div id='comment-form'>
            <form 
                action=<?= '"comments_post.php?article_id='.$article_id.'"' ?> 
                method='POST'>
                <div>
                    <label for='name'>Name</label>
                    <input id='name' type='text' name='name' maxlength=50 required />
                </div>
               
                <div>
                    <label for='comment'>Comment</label>
                    <textarea id='comment' name='comment'></textarea>
                </div>
                
                <input type='submit' value='Submit' />
            </form>
        </div>

        
    </main>
    
    <footer>
        <a href='index.php'>Back to articles</a>
    </footer>
</body>
