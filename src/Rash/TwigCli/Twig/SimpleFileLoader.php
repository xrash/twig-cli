<?php

namespace Rash\TwigCli\Twig;

class SimpleFileLoader implements \Twig_LoaderInterface
{
    public function getSource($name)
    {
        try {
            return file_get_contents($name);
        } catch (\Exception $e) {
            throw new \Twig_Error_Loader("Filename {$name} could not be loaded.");
        }
    }

    public function getCacheKey($name)
    {
        return $name;
    }

    public function isFresh($name, $time)
    {
        return true;
    }

    public function exists($name)
    {
        return file_exists($name);
    }
}
