<?php

namespace View;

class ThemesNew extends AbstractView
{
    private $theme;

    public function __construct($theme)
    {
        $this->template = \App::getBaseDir() . DS . 'code' . DS . 'templates' . DS . 'theme_new.phtml';
        $this->theme = $theme;
    }

    public function getTheme(){
        return $this->theme;
    }




}
