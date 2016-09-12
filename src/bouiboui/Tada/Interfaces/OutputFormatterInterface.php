<?php


namespace bouiboui\Tada\Interfaces;


interface OutputFormatterInterface
{
    /**
     * @param $string
     * @return OutputFormatterInterface
     */
    public function setInput($string);

    /** @return OutputFormatterInterface */
    public function addUnderline();

    /** @return OutputFormatterInterface */
    public function addBold();

    /** @return OutputFormatterInterface */
    public function setNormal();

    /** @return OutputFormatterInterface */
    public function addYellow();

    /** @return OutputFormatterInterface */
    public function addItalic();

    /** @return OutputFormatterInterface */
    public function addRed();

    /** @return OutputFormatterInterface */
    public function addGreen();

    /** @return OutputFormatterInterface */
    public function addGrey();

    /** @return OutputFormatterInterface */
    public function addNewLine();

}
