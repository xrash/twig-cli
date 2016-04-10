<?php

namespace Rash\TwigCli\Twig;

class Compiler {
    private $twigEnvironment;

    public function __construct() {
        $loader = new SimpleFileLoader();
        $this->env = new \Twig_Environment($loader);
    }

    public function compile($file, $data) {
        return $this->env->render($file, $data);
    }
}
