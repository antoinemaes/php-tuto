<?php

namespace Antoine\blog\model;


/**
 *
 */
interface CommentManager
{
  public function getCommentsFromArticle($article_id);
  public function putComment(Comment $comment);
}
