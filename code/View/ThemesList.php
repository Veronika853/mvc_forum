<?php

namespace View;

class ThemesList extends AbstractView
{
    private $themesCollection;

    public function __construct($themesCollection)
    {
        $this->template = \App::getBaseDir() . DS . 'code' . DS . 'templates' . DS . 'theme_list.phtml';
        $this->themesCollection = $themesCollection;
    }

    public function getThemesCollection()
    {
        return $this->themesCollection;
    }
}
