<?php


namespace bouiboui\Tada\Controllers;


use bouiboui\Tada\Interfaces\OutputInterface;
use bouiboui\Tada\Models\Todo;

class ConsoleOutput implements OutputInterface
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
        $this->printLine($this->format()->setNormal());
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
    public function format($input = null)
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
        $instance = $this;
        $formatSubtitle = function ($string) use ($instance) {
            return $instance->format($string)->addYellow();
        };

        // Context style
        $context = $todo->getContext();
        $formattedContext = $this->format($context)->setNormal();
        if ('' === $context) {
            $formattedContext->setInput(' (empty)')->addItalic();
        }

        // General style
        $this->printLines(array(
            $this->format('TODO')->addGrey()->addBold(),
            $formatSubtitle('Origin'),
            $this->format($todo->getOrigin() . ':' . $todo->getLine())->setNormal(),
            $formatSubtitle('Contents'),
            $this->format($todo->getContents())->setNormal(),
            $formatSubtitle('Context'),
            $formattedContext,
            $this->format()->addNewLine()
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
