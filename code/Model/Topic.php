<?php

namespace Model;

class Topic
{
    private $id;
    private $name;
    private $themeId;
    private $content;
    private $createdAt;

    public function __construct($themeId, $name = null, $content = null, $createdAt = null, $id = null)
    {
        $this->name = $name;
        $this->themeId = $themeId;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getThemeId()
    {
        return $this->themeId;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setThemeId($themeId)
    {
        $this->themeId = $themeId;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}