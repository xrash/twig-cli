<?php

namespace Rash\TwigCli;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;

class ConsoleApplication extends Application
{
    protected function getCommandName(InputInterface $input)
    {
        return __CLI_NAME;
    }

    // Clear out the normal first argument, which is the command name.
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        $inputDefinition->setArguments();
        return $inputDefinition;
    }
}
