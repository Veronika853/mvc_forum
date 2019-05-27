<?php

namespace Model;

use mysqli;

class TopicRepository
{
    private $dbAdapter = null;

    public function __construct()
    {
        $this->dbAdapter = new mysqli('127.0.0.1', 'root', '', 'forum');
    }

    public function getTopicById($id)
    {
        $statement = $this->dbAdapter->query("SELECT * from topics where id = {$id}");
        $row = $statement->fetch_assoc();
        $topic = new Topic($row['theme_id'], $row['name'], $row['content'], $row['created_at'], $row['id']);

        return $topic;
    }

    public function getTopicsCollection($themeId)
    {
        $statement = $this->dbAdapter->query("SELECT * FROM topics WHERE theme_id = {$themeId}");
        $topics = [];
        while ($row = $statement->fetch_assoc()) {
            $topics[$row['id']] = new Topic($row['theme_id'], $row['name'], $row['content'], $row['created_at']);
            $topics[$row['id']]->setThemeId($row['theme_id']);
            $topics[$row['id']]->setName($row['name']);
            $topics[$row['id']]->setId($row['id']);
            $topics[$row['id']]->setCreatedAt($row['created_at']);
        }
        return $topics;
    }

    public function saveTopic(Topic $topic)
    {
        $id = $this->dbAdapter->real_escape_string($topic->getId());
        $name = $this->dbAdapter->real_escape_string($topic->getName());
        $content = $this->dbAdapter->real_escape_string($topic->getContent());
        $themeId = $this->dbAdapter->real_escape_string($topic->getThemeId());
        if ($id == null){
            $this->dbAdapter->query("INSERT INTO topics (name, content, theme_id) VALUES ('{$name}', '{$content}', '{$themeId}')");
        } else {
            $this->dbAdapter->query("UPDATE topics SET name='{$name}', content='{$content}', theme_id='{$themeId}' WHERE id={$id}");
        }
    }

    public function deleteTopic($id)
    {
        $this->dbAdapter->query("DELETE FROM topics WHERE id={$id}");
    }
}