<?php


namespace bouiboui\Tada\Helpers;


use bouiboui\Tada\Exceptions\FileSystemException;

class FileSystem
{
    const TYPE_ERROR = 0;
    const TYPE_FILE = 1;
    const TYPE_FOLDER = 2;

    const RECURSIVE = 0x1;

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
     * @param $path
     * @param int $options
     * @return \string[]
     */
    public function scanFolder($path, $options = null)
    {
        // Returns the path of every item in the folder
        $paths = array_map(function ($fileName) use ($path) {
            return realpath($path . '/' . $fileName);
        }, array_diff(scandir($path), ['.', '..']));

        // Recursive search for children paths
        if ($options & static::RECURSIVE) {
            foreach (array_filter($paths, 'is_dir') as $subpath) {
                foreach ($this->scanFolder($subpath, static::RECURSIVE) as $subItems) {
                    $paths[] = $subItems;
                }
            }
        }
        // Returns only the files in $path
        return array_filter($paths, 'is_file');
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