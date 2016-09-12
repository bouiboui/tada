<?php


namespace bouiboui\Tada\Nulls;


use bouiboui\Tada\Interfaces\Output;
use bouiboui\Tada\Interfaces\OutputFormatter;

class NullOutput implements Output
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
     * @return OutputFormatter
     */
    public function format($input)
    {
        return new NullOutputFormatter;
    }

    public function printSuccess($string)
    {
    }
}