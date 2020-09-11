<!DOCTYPE HTML>

<head>
  <title>My blog</title>
  <meta charset='utf-8'>
</head>

<body>

  <main>
    <h1>Welcome to my blog</h1>

    <?php
      foreach ($articles as $article) {
    ?>
    <div class='article'>
      <h2>
        <a
          href=<?=
            '"index.php?action=showComments'
            .'&article_id='.$article->getId().'"'?>>
          <?= htmlspecialchars($article->getTitle())?>
        </a>
      </h2>
      <h3><?= htmlspecialchars($article->getDate())?></h3>
      <p>
        <?php
          $full=nl2br(htmlspecialchars($article->getContent()));
          $sub=substr($full, 0, 200);
          echo $sub;
          if (strlen($sub)!=strlen($full))
            echo ' [...]';
        ?>
      </p>
    </div>
    <?php
        }
    ?>
  </main>

  <footer>
    <?php
      for ($i=1;$i<=$count/5+1;$i++) {
        echo '<a href="index.php?action=showArticles&page=' . $i . '">' . $i . '</a> ';
      }
    ?>
  </footer>

</body>
