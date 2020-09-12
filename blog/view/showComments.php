<!DOCTYPE HTML>

<head>
    <title>My blog</title>
    <meta charset='utf-8'>
</head>

<body>

  <main>

    <h1>Welcome to my blog</h1>

    <div class='article'>
      <h2><?= htmlspecialchars($article->getTitle()) ?></h2>
        <h3><?= htmlspecialchars($article->getDate()) ?></h3>
        <p><?= nl2br(htmlspecialchars($article->getContent())) ?></p>
    </div>

    <div id='comment-section'>
      <h2>Comments</h2>
      <?php forEach($comments as $comment) { ?>

      <div class='comment'>
        <p>
          <strong><?= htmlspecialchars($comment->getAuthor()) ?></strong>,
          <?= $comment->getDate() ?>
        </p>
        <p><?= nl2br(htmlspecialchars($comment->getContent())) ?></p>
      </div>

      <?php } ?>
    </div>

    <div id='comment-form'>
      <form
        action=<?= '"index.php?action=postComment&article_id='.$article_id.'"' ?>
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
    <a href='index.php?action=showArticles'>Back to articles</a>
  </footer>

</body>
