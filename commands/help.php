<?php

namespace Commands;

class Help
{
    private $args;
    private $helper;

    public function __construct(array $args, \Lib\Helper $helper)
    {
        $this->args = $args;
        $this->helper = $helper;
    }

    public function run()
    {

        $this->helper->out("\nCommand List:\n");
        $this->helper->out("-------------\n");
        $this->helper->display("1) get-salary-dates [ year ]");
        $this->helper->out('Description: ');
        $this->helper->out("Generates csv file contaning month names\n");
        $this->helper->out("\t     for an year with the salary and bonus dates\n\n");
    }
}