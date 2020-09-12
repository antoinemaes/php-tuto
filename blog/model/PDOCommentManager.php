<?php

namespace Antoine\blog\model;

/**
 *
 */
class PDOCommentManager implements CommentManager
{

  const QUERY_GET =
    'SELECT author, date, content FROM Comment WHERE article_id=?';
  const QUERY_PUT =
    'INSERT INTO Comment (author, content, article_id) VALUES (?, ?, ?)';


  private $_pdo;

  public function __construct()
  {
    try {
        $this->_pdo = new \PDO(
          'mysql:host=localhost;dbname=blog;charset=utf8',
          'antoine',
          'sqvmf72w');
    }
    catch (\PDOException $e) {
      // TODO error management:
        die('Error : ' . $e->getMessage());
    }
  }

  public function getCommentsFromArticle($article_id) {

      $request=$this->_pdo->prepare(self::QUERY_GET);

      $request->execute(array($article_id));
      $request->setFetchMode(\PDO::FETCH_CLASS, 'Antoine\blog\model\Comment');

      return $request->fetchAll();
  }

  public function putComment(Comment $comment) {
      $req = $this->_pdo->prepare(self::QUERY_PUT);
      $req->execute(
        array(
          $comment->getAuthor(),
          $comment->getContent(),
          $comment->getArticleId()));
      $comment->setId($this->_pdo->lastInsertId());
  }
}
