<?php


namespace bouiboui\Tada\Helpers;


use bouiboui\Tada\Exceptions\FileSystemException;

class FileSystem
{
    const TYPE_ERROR = 0;
    const TYPE_FILE = 1;
    const TYPE_FOLDER = 2;

    /**
     * Returns file contents
     *
     * @param $filePath
     * @return string
     * @throws FileSystemException
     */
    public function readFile($filePath)
    {
        if (!is_readable($filePath)) {
            throw new FileSystemException($filePath . ' is unreadable (check permissions).');
        }
        return file_get_contents($filePath);
    }

    /**
     * Returns a list of absolute paths to files from a folder
     * Ignores folders, . and ..
     *
     * @param $folderPath
     * @return string[]
     */
    public function scanFolder($folderPath)
    {
        return array_filter(array_map(function ($filePath) use ($folderPath) {
            return realpath($folderPath . '/' . $filePath);
        }, array_diff(scandir($folderPath), ['.', '..'])), 'is_file');
    }

    /**
     * Tells if a path leads to a file or a folder
     *
     * @param $target
     * @return int
     */
    public function getType($target)
    {
        if (file_exists($target)) {
            if (is_file($target)) {
                return static::TYPE_FILE;
            }
            if (is_dir($target)) {
                return static::TYPE_FOLDER;
            }
        }
        return static::TYPE_ERROR;
    }

}