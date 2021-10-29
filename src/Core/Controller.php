<?php

namespace Jumia\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller
{
    protected function load(string $view, $viewData = [])
    {
        $twig = new Environment(new FilesystemLoader('./views/'));

        echo $twig->render($view.'.twig.php', $viewData);
    }
}
