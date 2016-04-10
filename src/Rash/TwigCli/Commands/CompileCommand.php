<?php

namespace Rash\TwigCli\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

use Rash\TwigCli\Twig\Compiler;

class CompileCommand extends Command
{
    private $twigCompiler;

    public function __construct()
    {
        parent::__construct();
        $this->twigCompiler = new Compiler();
    }

    protected function configure()
    {
        $this
            ->setName(__CLI_NAME)
//            ->addOption('environment', 'e', InputOption::VALUE_REQUIRED, 'The internal Twig Environment directory.')
//            ->addOption('output', 'o', InputOption::VALUE_REQUIRED, '')
            ->addOption('param', 'p', InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Key/value parameter in the format key=value.')
            ->addArgument('files', InputArgument::IS_ARRAY, 'Input files.')
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $params = $input->getOption('param');
        $files = $input->getArgument('files');

        // Process the data.
        $data = array();
        foreach ($params as $param) {
            $pos = strpos($param, '=');

            // Both false and zero... There must be a key.
            if (!$pos) {
                $output->writeln("Param {$param} could not be correctly split.");
                continue;
            }

            $key = substr($param, 0, $pos);
            $value = substr($param, $pos + 1, strlen($param));

            $data[$key] =  $value;
        }

        // If there is no input file, the input is stdin.
        if (count($files) < 1) {
            $files[] = 'php://stdin';
        }

        // Walk through every input file and compile it.
        foreach ($files as $file) {
            try {
                $result = $this->twigCompiler->compile($file, $data);
            } catch (\Exception $e) {
                $output->writeln($e->getMessage());
                return false;
            }

            if (!file_put_contents('php://stdout', $result)) {
                $output->writeln("Could not output the result for {$file}");
                return false;
            }
        }

        // In the end, just return true.
        return true;
    }
}
