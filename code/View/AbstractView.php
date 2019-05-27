<?php

namespace View;

abstract class AbstractView
{
    protected $template;

    public function render()
    {
        include_once $this->template;
    }
}
