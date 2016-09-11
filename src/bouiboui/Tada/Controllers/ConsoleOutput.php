<?php


namespace bouiboui\Tada\Controllers;


use bouiboui\Tada\Interfaces\Output;
use bouiboui\Tada\Models\Todo;

class ConsoleOutput implements Output
{
    /**
     * Displays a string formatted as an error
     * @param $description
     */
    public function printError($description)
    {
        // Title
        $this->printLine($this->format('Error')->addRed());
        // Error description
        $this->printLine($description);
    }

    /**
     * Displays one line followed by a newline
     * @param $string
     */
    public function printLine($string)
    {
        echo $string . ConsoleFormatter::NEW_LINE;
    }

    /**
     * Returns an utility to format output
     * @param $input
     * @return ConsoleFormatter
     */
    public function format($input)
    {
        $formatter = new ConsoleFormatter();
        $formatter->setInput($input);
        return $formatter;
    }

    /**
     * Displays a string formatted as a succesful message
     * @param $string
     */
    public function printSuccess($string)
    {
        $this->printLine($this->format($string)
            ->addBold()
            ->addGreen());
    }

    /**
     * Formats and displays a TODO to the output
     * @param Todo $todo
     */
    public function displayTodo(Todo $todo)
    {
        // Subtitle style
        $formatSubtitle = function ($string) {
            return $this->format($string)
                //->addUnderline()
                ->addYellow();
        };

        $context = $todo->getContext();
        $formattedContext = $this->format($context)->setNormal();
        if ('' === $context) {
            $formattedContext->setInput(' (empty)');
            $formattedContext->addItalic();
        }
        $this->printLines(array(
            $this->format('TODO')->addGrey()->addBold(),
            $formatSubtitle('Origin'),
            $this->format($todo->getOrigin() . ':' . $todo->getLine())->setNormal(),
            $formatSubtitle('Contents'),
            $this->format($todo->getContents())->setNormal(),
            $formatSubtitle('Context'),
            $formattedContext
        ));

    }

    /**
     * Displays multiple lines
     * @param array $lines
     */
    public function printLines(array $lines)
    {
        foreach ($lines as $line) {
            $this->printLine($line);
        }
    }
}