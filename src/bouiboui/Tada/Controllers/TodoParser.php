<?php


namespace bouiboui\Tada\Controllers;


use bouiboui\Tada\Models\Todo;

class TodoParser
{
    /**
     * @param $contents
     * @param $origin
     * @return Todo[]
     */
    public function parse($contents, $origin = '')
    {
        $todos = array();
        $todoLineOffset = 1;
        $lines = explode("\n", str_replace("\r\n", "\n", $contents));
        foreach ($lines as $lineContents) {

            if (static::lineHasTodo($lineContents)) {
                $lineIndentation = static::getIndentationPosition($lineContents);
                $context = array();
                // $todoLineOffset = Don't include the TODO line in the context
                foreach (array_slice($lines, $todoLineOffset) as $contextLine) {

                    // if next line is not a todo
                    $isTodo = static::lineHasTodo($contextLine);

                    // if next line is not an empty line
                    $isEmpty = trim($contextLine) === '';

                    // if next line is not at a lower indentation
                    $isLowerIndentation = static::getIndentationPosition($contextLine) < $lineIndentation;

                    if ($isTodo || $isEmpty || $isLowerIndentation) {
                        break;
                    }
                    // Remove indentation and save context
                    $context[] = substr($contextLine, $lineIndentation);
                }
                $todo = new Todo();
                $todo->setOrigin($origin);
                $todo->setContents(substr($lineContents, $lineIndentation));
                $todo->setContext(implode(PHP_EOL, $context));
                $todo->setLine($todoLineOffset);

                $todos[] = $todo;
            }
            $todoLineOffset++;
        }
        return $todos;
    }

    private static function lineHasTodo($line)
    {
        return strpos(strtolower($line), 'todo') > -1;
    }

    private static function getIndentationPosition($line)
    {
        return strlen($line) - strlen(trim($line));
    }

}
