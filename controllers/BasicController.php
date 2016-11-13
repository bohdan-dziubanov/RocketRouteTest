<?php

namespace controllers;

class BasicController
{
    protected $args = [];

    protected function includeTemplate($fileName)
    {
        foreach ($this->args as $key => $value)
        {
            $$key = $value;
        }

        include 'templates/layouts/header.php';

        include 'templates/' . $fileName;

        include 'templates/layouts/footer.php';
    }
}

