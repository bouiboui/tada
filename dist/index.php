<?php

use bouiboui\Tada\Controllers\ConsoleOutput;
use bouiboui\Tada\Exceptions\ArgumentException;
use bouiboui\Tada\Exceptions\FileSystemException;
use bouiboui\Tada\Exceptions\TadaException;
use bouiboui\Tada\TadaApp;

include_once dirname(__DIR__) . '/vendor/autoload.php';

$app = new TadaApp;
$app->setOutput($output = new ConsoleOutput);

try {

    // Parse arguments
    if (count($argv) < 2) {
        throw new ArgumentException('Please specify the target as an argument.');
    }

    // Ignore the first value of $argv (the file that runs this script)
    array_shift($argv);

    // Look for recursive option
    $recursive = in_array(TadaApp::OPTION_RECURSIVE_SHORT, $argv, true)
        || in_array(TadaApp::OPTION_RECURSIVE_LONG, $argv, true);

    $todos = array();

    // For each argument
    foreach ($argv as $target) {
        // Skip flags
        if (in_array($target, TadaApp::POSSIBLE_OPTIONS, true)) {
            continue;
        }
        try {

            $todos = $recursive
                ? $app->parseTargetRecursive($target)
                : $app->parseTarget($target);

            // Parse files/dirs
            foreach ($todos as $todo) {
                // Display results in the console
                $output->displayTodo($todo);
                $app->exportTodo($todo);
            }

        } catch (FileSystemException $e) {
            throw new TadaException('There was an error with file/folder ' . $target);
        }
    }

    // All done!
    $output->printSuccess(count($todos) . ' TODO(s) found.');

} catch (ArgumentException $e) {
    $output->printError($e->getMessage());
} catch (TadaException $e) {
    $output->printError($e->getMessage());
} catch (\Exception $e) {
    $output->printError($e->getMessage());
}
