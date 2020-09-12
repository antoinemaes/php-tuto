<?php

namespace Antoine\blog\model;

/**
 *
 */
class PDOArticleManager implements ArticleManager
{
  const QUERY_COUNT='SELECT COUNT(*) FROM Article';
  const QUERY_LAST='SELECT id, title, date, content '
    .'FROM Article ORDER BY date DESC LIMIT ?, ?';
  const QUERY_ID='SELECT id, title, date, content '
    .'FROM Article WHERE id=?';

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

  public function getArticleCount() {

    $response=$this->_pdo->query(self::QUERY_COUNT);
    $line = $response->fetch();
    return $line[0];

  }

  public function getLastArticles($page=1, $limit=5) {

    $request=$this->_pdo->prepare(self::QUERY_LAST);
    $request->bindValue(1, $limit*($page-1), \PDO::PARAM_INT);
    $request->bindValue(2, $limit, \PDO::PARAM_INT);

    $request->execute();
    $request->setFetchMode(\PDO::FETCH_CLASS, 'Antoine\blog\model\Article');

    return $request->fetchAll();

  }

  public function getArticleById($id) {

    $request=$this->_pdo->prepare(self::QUERY_ID);
    $request->execute(array($id));

    if($request) {
      $request->setFetchMode(\PDO::FETCH_CLASS, 'Antoine\blog\model\Article');
      return $request->fetch();
    }

  }
}
