<?php


namespace bouiboui\Tada\Helpers;


use bouiboui\Tada\Controllers\TodoParser;

class TodoFolderParser
{
    /**
     * @param $folderPath
     * @param int $options
     * @return \bouiboui\Tada\Models\Todo[]
     * @throws \bouiboui\Tada\Exceptions\FileSystemException
     */
    public function parse($folderPath, $options = null)
    {
        $todos = [];
        $fileSystem = new FileSystem;
        $parser = new TodoParser;
        // For each file in the folder
        foreach ($fileSystem->scanFolder($folderPath, $options & FileSystem::RECURSIVE) as $filePath) {
            // For each TODO found in the file
            foreach ($parser->parse($fileSystem->readFile($filePath), $filePath) as $todo) {
                // Add to $todos returned
                $todos[] = $todo;
            }
        }
        return $todos;
    }
}