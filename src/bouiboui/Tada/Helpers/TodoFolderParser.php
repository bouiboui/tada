<?php


namespace bouiboui\Tada\Helpers;


use bouiboui\Tada\Controllers\TodoParser;
use bouiboui\Tada\Models\Todo;

class TodoFolderParser
{

    /**
     * @param $folderPath
     * @return Todo[]
     * @throws \bouiboui\Tada\Exceptions\FileSystemException
     */
    public function parse($folderPath)
    {
        $todos = [];
        $fileSystem = new FileSystem;
        $parser = new TodoParser;
        // For each file in the folder
        foreach ($fileSystem->scanFolder($folderPath) as $filePath) {
            // For each TODO found in the file
            foreach ($parser->parse($fileSystem->readFile($filePath), $filePath) as $todo) {
                // Add to $todos returned
                $todos[] = $todo;
            }
        }
        return $todos;
    }
}