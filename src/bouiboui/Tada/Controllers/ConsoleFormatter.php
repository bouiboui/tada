<?php


namespace bouiboui\Tada\Controllers;


use bouiboui\Tada\Interfaces\OutputFormatter;

class ConsoleFormatter implements OutputFormatter
{
    const FORMAT_OFF = "\e[0m";

    const FORMAT_BOLD_ON = "\e[1m";
    const FORMAT_BOLD_OFF = "\e[22m";

    const ITALICS_ON = "\e[3m";
    const ITALICS_OFF = "\e[23m";

    const UNDERLINE_ON = "\e[4m";
    const UNDERLINE_OFF = "\e[24m";

    const FORMAT_COLOR_RED = "\e[31m";
    const FORMAT_COLOR_GREEN = "\e[32m";
    const FORMAT_COLOR_YELLOW = "\e[33m";
    const FORMAT_COLOR_GREY = "\e[37m";
    const FORMAT_COLOR_DEFAULT = "\e[39m";

    const NEW_LINE = PHP_EOL;

    /** @var string $input */
    private $input;

    public function setInput($string)
    {
        $this->input = $string;
        return $this;
    }

    public function addUnderline()
    {
        return $this->addFormat(function ($string) {
            return static::UNDERLINE_ON . $string . static::UNDERLINE_OFF;
        });
    }

    private function addFormat($format)
    {
        $this->input = $format($this->input);
        return $this;
    }

    public function addBold()
    {
        return $this->addFormat(function ($string) {
            return static::FORMAT_BOLD_ON . $string . static::FORMAT_BOLD_OFF;
        });
    }

    public function setNormal()
    {
        return $this->addFormat(function ($string) {
            return static::FORMAT_COLOR_DEFAULT . $string;
        });
    }

    public function addYellow()
    {
        return $this->addFormat(function ($string) {
            return static::FORMAT_COLOR_YELLOW . $string;
        });
    }

    public function __toString()
    {
        return $this->input;
    }

    public function addItalic()
    {
        return $this->addFormat(function ($string) {
            return static::ITALICS_ON . $string . static::ITALICS_OFF;
        });
    }

    public function addRed()
    {
        return $this->addFormat(function ($string) {
            return static::FORMAT_COLOR_RED . $string;
        });
    }

    public function addGreen()
    {
        return $this->addFormat(function ($string) {
            return static::FORMAT_COLOR_GREEN . $string;
        });
    }

    public function addGrey()
    {
        return $this->addFormat(function ($string) {
            return static::FORMAT_COLOR_GREY . $string;
        });
    }

    public function addNewLine()
    {
        $this->input .= static::NEW_LINE;
        return $this;
    }
}