<?php

namespace bouiboui\Tada;

use bouiboui\Tada\Exceptions\FileSystemException;
use bouiboui\Tada\Helpers\FileSystem;
use bouiboui\Tada\Helpers\TodoFileParser;
use bouiboui\Tada\Helpers\TodoFolderParser;
use bouiboui\Tada\Interfaces\Exporter;
use bouiboui\Tada\Interfaces\Output;
use bouiboui\Tada\Models\Todo;
use bouiboui\Tada\Nulls\NullExporter;
use bouiboui\Tada\Nulls\NullOutput;

class TadaApp
{
    /** @var Output $output */
    private $output;
    /** @var Exporter $exporter */
    private $exporter;

    public function __construct()
    {
        $this->output = new NullOutput;
        $this->exporter = new NullExporter;
    }


    /**
     * Return an array of TODOs from the specified target.
     * Target can be either a file or a folder.
     *
     * @param $target
     * @return Todo[]
     * @throws FileSystemException
     */
    public function parseTarget($target)
    {
        // Detect whether $target is a file or a folder
        switch ((new FileSystem)->getType($target)) {

            case FileSystem::TYPE_FILE:
                return (new TodoFileParser)->parse($target);

            case FileSystem::TYPE_FOLDER:
                return (new TodoFolderParser)->parse($target);

            default:
                throw new FileSystemException('Invalid target type.');

        }
    }

    /** @return Output */
    public function getOutput()
    {
        return $this->output;
    }

    /** @param Output $output */
    public function setOutput(Output $output)
    {
        $this->output = $output;
    }

    /** @param Exporter $param */
    public function setExporter(Exporter $param)
    {
        $this->exporter = $param;
    }

    /** @param Todo $todo */
    public function exportTodo(Todo $todo)
    {
        $this->exporter->export($todo);
    }

}