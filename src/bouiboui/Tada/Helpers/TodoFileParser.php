<?php


namespace bouiboui\Tada\Helpers;


use bouiboui\Tada\Controllers\TodoParser;

class TodoFileParser
{

    /**
     * Parse a single file and return TODOs
     *
     * @param $target
     * @return \bouiboui\Tada\Models\Todo[]
     * @throws \bouiboui\Tada\Exceptions\FileSystemException
     */
    public function parse($target)
    {
        return (new TodoParser)->parse(
            (new FileSystem)->readFile($target),
            $target // Origin
        );
    }
}