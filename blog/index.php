<?php

require('model/data_access.php');

$page=isset($_GET['page']) ? $_GET['page'] : 1;
$count=getArticleCount();
$articles=getArticles($page);

require('view/articles.php');
