<?php


namespace bouiboui\Tada\Nulls;


use bouiboui\Tada\Interfaces\OutputFormatter;

class NullOutputFormatter implements OutputFormatter
{
    public function setInput($string)
    {
        return $this;
    }

    public function addUnderline()
    {
        return $this;
    }

    public function addBold()
    {
        return $this;
    }

    public function setNormal()
    {
        return $this;
    }

    public function addYellow()
    {
        return $this;
    }

    public function addItalic()
    {
        return $this;
    }

    public function addRed()
    {
        return $this;
    }

    public function addGreen()
    {
        return $this;
    }

    public function addGrey()
    {
        return $this;
    }

    public function addNewLine()
    {
        return $this;
    }
}
