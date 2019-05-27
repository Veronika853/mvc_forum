<?php

namespace View;

class TopicsNew extends AbstractView
{
    private $topic;

    public function __construct($topic)
    {
        $this->template = \App::getBaseDir() . DS . 'code' . DS . 'templates' . DS . 'topic_new.phtml';
        $this->topic = $topic;
    }

    public function getTopic()
    {
        return $this->topic;
    }
}
