<?php

namespace app\traits;

use app\classes\TwigFilters;
use Exception;
use Slim\Views\Twig;

trait Template
{

    protected $twig;

    public function getTwig()
    {
        try {

            $twig =  Twig::create(DIR_VIEWS);
            $twig->addExtension(new TwigFilters);
            return $twig;

        } catch (Exception $e) {
            
            var_dump($e->getMessage());
        }
    }

    public function setView($name)
    {
        return $name . EXT_VIEWS;
    }

}