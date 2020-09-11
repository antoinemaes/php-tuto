<?php

/**
 *
 */
interface ArticleManager
{
  public function getArticleCount();
  public function getLastArticles($page=1, $limit=5);
  public function getArticleById($id);
}
