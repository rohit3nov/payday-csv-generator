<?php

namespace Lib;

class App
{
    private $registry = [];
    private $helper;

    public function __construct(\Lib\Helper $helper)
    {
        $this->helper = $helper;
    }

    public function registerCommand(string $name, callable|array $callable)
    {
        $this->registry[$name] = $callable;
    }

    public function getCommand(string $command): callable|array|null
    {
        return isset($this->registry[$command]) ? $this->registry[$command] : null;
    }

    public function runCommand(array $argv)
    {
        $command_name = "help";

        if (isset($argv[1])) {
            $command_name = $argv[1];
        }
        $command = $this->getCommand($command_name);
        if ($command === null) {
            $this->helper->display("ERROR: Command \"$command_name\" not found.");
            exit;
        }
        call_user_func($command, $argv);
    }
}
