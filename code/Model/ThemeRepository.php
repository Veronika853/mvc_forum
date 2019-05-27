<?php

namespace Model;

use mysqli;

class ThemeRepository
{
    private $dbAdapter = null;

    public function __construct()
    {
        $this->dbAdapter = new mysqli('127.0.0.1', 'root', '', 'forum');
    }

    public function getThemeById($id)
    {
        $statement = $this->dbAdapter->query("SELECT * from themes where id = {$id}");
        $row = $statement->fetch_assoc();
        $theme = new Theme($row['name'], $row['description']);
        $theme->setName($row['name']);
        $theme->setId($row['id']);
        $theme->setDescription($row['description']);

        return $theme;
    }

    public function getThemesCollection()
    {
        $statement = $this->dbAdapter->query("SELECT * FROM themes");
        $themes = [];
        while ($row = $statement->fetch_assoc()) {
            $themes[$row['id']] = new Theme($row['name'], $row['description'], $row['created_at']);
            $themes[$row['id']]->setName($row['name']);
            $themes[$row['id']]->setId($row['id']);
            $themes[$row['id']]->setCreatedAt($row['created_at']);
        }

        $statement = $this->dbAdapter->query("SELECT topics.* from topics inner join themes on topics.theme_id = themes.id order by created_at");
        while ($row = $statement->fetch_assoc()) {
            $themes[$row['theme_id']]->setTopicTimestamp($row['created_at']);
            $themes[$row['theme_id']]->setTopicName($row['name']);
        }
        return $themes;
    }

    public function saveTheme(Theme $theme){
        $id = $this->dbAdapter->real_escape_string($theme->getId());
        $name = $this->dbAdapter->real_escape_string($theme->getName());
        $description = $this->dbAdapter->real_escape_string($theme->getDescription());
        if ($id == null) {
            $this->dbAdapter->query("INSERT INTO themes (name, description) VALUES ('{$name}', '{$description}')");
        } else {
            $this->dbAdapter->query("UPDATE themes SET name='{$name}', description='{$description}' WHERE id={$id}");
        }
    }

    public function deleteTheme($id){
        $this->dbAdapter->query("DELETE FROM themes WHERE id={$id}");
    }

}
