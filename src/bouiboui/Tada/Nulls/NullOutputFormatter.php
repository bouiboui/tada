<?php


namespace bouiboui\Tada\Nulls;


use bouiboui\Tada\Interfaces\OutputFormatterInterface;

class NullOutputFormatter implements OutputFormatterInterface
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
