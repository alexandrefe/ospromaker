<?php


namespace app\classes;


class TwigGlobal
{
    private static $variables = [];

    public static function set($key, $value)
    {
        if(!isset(static::$variables[$key])) {
            static::$variables[$key] = $value;
        }
    }

    public static function load($twig)
    {
        $env = $twig->getEnvironment();
        foreach (static::$variables as $key => $variable) {
            $env->addGlobal($key, $variable);
        }

    }
}