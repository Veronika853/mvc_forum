<?php

namespace View;

class TopicsList extends AbstractView
{
    private $topicsCollection;
    private $themeId;

    public function __construct($topicsCollection, $themeId)
    {
        $this->template = \App::getBaseDir() . DS . 'code' . DS . 'templates' . DS . 'topic_list.phtml';
        $this->topicsCollection = $topicsCollection;
        $this->themeId = $themeId;
    }

    public function getTopicsCollection()
    {
        return $this->topicsCollection;
    }
    public function getThemeId(){
        return $this->themeId;
    }
}