<?php


namespace bouiboui\Tada\Nulls;


use bouiboui\Tada\Interfaces\OutputInterface;
use bouiboui\Tada\Interfaces\OutputFormatterInterface;

class NullOutput implements OutputInterface
{

    public function printLines(array $lines)
    {
    }

    public function printError($description)
    {
    }

    public function printLine($string)
    {
    }

    /**
     * @param $input
     * @return OutputFormatterInterface
     */
    public function format($input)
    {
        return new NullOutputFormatter;
    }

    public function printSuccess($string)
    {
    }
}
