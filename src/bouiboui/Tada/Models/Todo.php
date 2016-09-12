<?php


namespace bouiboui\Tada\Models;


class Todo
{
    private $contents;
    private $context;
    private $line;
    private $origin;

    public function getContext()
    {
        return $this->context;
    }

    public function setContext($context)
    {
        $this->context = $context;
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function setContents($contents)
    {
        $this->contents = $contents;
    }

    public function getOrigin()
    {
        return $this->origin;
    }

    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    public function getLine()
    {
        return $this->line;
    }

    public function setLine($offset)
    {
        $this->line = $offset;
    }
}
