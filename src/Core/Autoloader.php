<?php

namespace App\Core;

class Autoloader
{
    /**
     * @return void
     */
    public static function register(): void
    {
        spl_autoload_register(function ($className): void {
            $path = str_replace('App', 'src', $className);

            $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);

            include_once ".." . DIRECTORY_SEPARATOR . "$path.php";
        });
    }
}
