<?php

namespace bouiboui\Tada;

use bouiboui\Tada\Exceptions\FileSystemException;
use bouiboui\Tada\Helpers\FileSystem;
use bouiboui\Tada\Helpers\TodoFileParser;
use bouiboui\Tada\Helpers\TodoFolderParser;
use bouiboui\Tada\Interfaces\ExporterInterface;
use bouiboui\Tada\Interfaces\OutputInterface;
use bouiboui\Tada\Models\Todo;
use bouiboui\Tada\Nulls\NullExporter;
use bouiboui\Tada\Nulls\NullOutput;

class TadaApp
{
    const OPTION_RECURSIVE_SHORT = '-r';
    const OPTION_RECURSIVE_LONG = '--recursive';
    const POSSIBLE_OPTIONS = array(
        TadaApp::OPTION_RECURSIVE_SHORT,
        TadaApp::OPTION_RECURSIVE_LONG
    );

    /** @var OutputInterface $output */
    private $output;
    /** @var ExporterInterface $exporter */
    private $exporter;

    public function __construct()
    {
        $this->output = new NullOutput;
        $this->exporter = new NullExporter;
    }

    /** @return OutputInterface */
    public function getOutput()
    {
        return $this->output;
    }

    /** @param OutputInterface $output */
    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;
    }

    /** @param ExporterInterface $param */
    public function setExporter(ExporterInterface $param)
    {
        $this->exporter = $param;
    }

    /** @param Todo $todo */
    public function exportTodo(Todo $todo)
    {
        $this->exporter->export($todo);
    }

    /**
     * Parses target recursively
     *
     * @param $target
     * @return Models\Todo[]
     * @throws FileSystemException
     */
    public function parseTargetRecursive($target)
    {
        return $this->parseTarget($target, FileSystem::RECURSIVE);
    }

    /**
     * Return an array of TODOs from the specified target.
     * Target can be either a file or a folder.
     *
     * @param $target
     * @param int $options
     * @return Models\Todo[]
     * @throws FileSystemException
     */
    public function parseTarget($target, $options = null)
    {
        // Detect whether $target is a file or a folder
        switch ((new FileSystem)->getType($target)) {

            case FileSystem::TYPE_FILE:
                return (new TodoFileParser)->parse($target);

            case FileSystem::TYPE_FOLDER:
                return (new TodoFolderParser)->parse($target, $options);

            default:
                throw new FileSystemException('Invalid target type.');

        }
    }

}
