<?php

namespace Antoine\blog\model;

class Comment {

    private $id;
    private $article_id;
    private $author;
    private $date;
    private $content;

    public function getId() {
      return $this->id;
    }

    public function getArticleId() {
      return $this->article_id;
    }

    public function getAuthor() {
      return $this->author;
    }

    public function getDate() {
      return $this->date;
    }

    public function getContent() {
      return $this->content;
    }

    public function setId($id) {
      $this->id = $id;
    }

    public function setArticleId($article_id) {
      $this->article_id = $article_id;
    }

    public function setAuthor($author) {
      if(!is_string($author) or empty($author) or strlen($author) > 50)
        throw new InvalidArgumentException(
          'Author must be a non-empty string of length inferior to 50.');
      $this->author = $author;
    }

    public function setDate(DateTime $date) {
      $this->date = $date;
    }

    public function setContent($content) {
      if(!is_string($content) or empty($content))
        throw new InvalidArgumentException(
          'Content must be a non-empty string.');
      $this->content = $content;
    }

}
