<?php


namespace bouiboui\Tada\Interfaces;


interface Output
{
    public function printLines(array $lines);

    public function printError($description);

    public function printLine($string);

    /**
     * @param $input
     * @return OutputFormatter
     */
    public function format($input);

    public function printSuccess($string);
}
