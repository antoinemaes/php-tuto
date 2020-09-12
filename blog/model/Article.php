<?php

namespace Antoine\blog\model;

class Article {

    private $id;
    private $title;
    private $date;
    private $content;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
      return $this->content;
    }

    /**
     * @param mixed $_id
     */
    public function setId($_id)
    {
        $this->id = $_id;
    }

    /**
     * @param mixed $_title
     */
    public function setTitle($_title)
    {
        $this->title = $_title;
    }

    /**
     * @param mixed $_date
     */
    public function setDate(DateTime $_date)
    {
        $this->date = $_date;
    }

    /**
     * @param mixed $_content
     */
    public function setContent($_content)
    {
        $this->content = $_content;
    }


}
