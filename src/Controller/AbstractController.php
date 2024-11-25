<?php

namespace App\Controller;

abstract class AbstractController
{
    /**
     * @param string $path
     * @param array $array
     *
     * @return void
     */
    protected function render(string $path, array $array = []): void
    {
        extract($array);

        ob_start();
        include_once "../templates/$path.php";
        $content = ob_get_clean();

        include_once '../templates/front/layout.php';
    }
}
