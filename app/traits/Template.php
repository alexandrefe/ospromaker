<?php

namespace app\traits;

use Exception;
use Slim\Views\Twig;

trait Template
{

    protected $twig;

    public function getTwig()
    {
        try {

            return Twig::create(DIR_VIEWS);

        } catch (Exception $e) {
            
            var_dump($e->getMessage());
        }
    }

    public function setView($name)
    {
        return $name . EXT_VIEWS;
    }

}