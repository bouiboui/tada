<?php


namespace bouiboui\Tada\Nulls;


use bouiboui\Tada\Interfaces\OutputFormatter;

class NullOutputFormatter implements OutputFormatter
{

    public function setInput($string)
    {
    }

    /** @return OutputFormatter */
    public function addUnderline()
    {
    }

    /** @return OutputFormatter */
    public function addBold()
    {
        return $this;
    }

    /** @return OutputFormatter */
    public function setNormal()
    {
        return $this;
    }

    /** @return OutputFormatter */
    public function addYellow()
    {
        return $this;
    }

    /** @return OutputFormatter */
    public function addItalic()
    {
        return $this;
    }

    /** @return OutputFormatter */
    public function addRed()
    {
        return $this;
    }

    /** @return OutputFormatter */
    public function addGreen()
    {
        return $this;
    }

    /** @return OutputFormatter */
    public function addGrey()
    {
        return $this;
    }
}