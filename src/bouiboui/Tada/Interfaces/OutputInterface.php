<?php


namespace bouiboui\Tada\Interfaces;


interface OutputInterface
{
    public function printLines(array $lines);

    public function printError($description);

    public function printLine($string);

    /**
     * @param $input
     * @return OutputFormatterInterface
     */
    public function format($input);

    public function printSuccess($string);
}
