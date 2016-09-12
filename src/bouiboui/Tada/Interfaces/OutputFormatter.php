<?php


namespace bouiboui\Tada\Interfaces;


interface OutputFormatter
{
    /**
     * @param $string
     * @return OutputFormatter
     */
    public function setInput($string);

    /** @return OutputFormatter */
    public function addUnderline();

    /** @return OutputFormatter */
    public function addBold();

    /** @return OutputFormatter */
    public function setNormal();

    /** @return OutputFormatter */
    public function addYellow();

    /** @return OutputFormatter */
    public function addItalic();

    /** @return OutputFormatter */
    public function addRed();

    /** @return OutputFormatter */
    public function addGreen();

    /** @return OutputFormatter */
    public function addGrey();

    /** @return OutputFormatter */
    public function addNewLine();

}
