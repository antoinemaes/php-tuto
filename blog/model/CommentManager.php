<?php

/**
 *
 */
interface CommentManager
{
  public function getCommentsFromArticle($article_id);
  public function putComment(Comment $comment);
}
