<?php

namespace Model;

class Theme
{
    private $id;
    private $name;
    private $description;
    private $createdAt;
    private $topicName;
    private $topicTimestamp;

    public function __construct($name = null, $description = null, $createdAt = null, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getTopicName()
    {
        return $this->topicName;
    }

    public function getTopicTimestamp()
    {
        return $this->topicTimestamp;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setTopicName($topicName)
    {
        $this->topicName = $topicName;
    }

    public function setTopicTimestamp($topicTimestamp)
    {
        $this->topicTimestamp = $topicTimestamp;
    }
}
