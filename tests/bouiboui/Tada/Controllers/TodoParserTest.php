<?php


namespace bouiboui\Tada\Controllers;


use bouiboui\Tada\Helpers\FileSystem;
use bouiboui\Tada\Helpers\TodoFolderParser;

define('TESTS_DATA_DIR', realpath(dirname(dirname(dirname(__DIR__))) . '/data'));

class TodoParserTest extends \PHPUnit_Framework_TestCase
{
    /** @var TodoParser $parser */
    private $parser;

    public function testParseEmptyString()
    {
        self::assertCount(0, $this->parser->parse(''));
    }

    public function testParseOneTodoString()
    {
        $todos = $this->parser->parse('TODO parse this todo');
        self::assertCount(1, $todos);
    }

    public function testParseMultipleTodoString()
    {
        $todos = $this->parser->parse('
        TODO parse this todo
        todo paerqe
        toDO qzfzef
        // TODo zqkjn
        /* todo zfiqzjefiqzeifqjzef */
        ');
        self::assertCount(5, $todos);
    }

    public function testSingleContextTodoString()
    {
        $todos = $this->parser->parse('TODO parse this todo');
        self::assertCount(1, $todos);
        self::assertCount(1, explode(PHP_EOL, $todos[0]->getContext()));
    }

    public function testMultipleContextTodoString()
    {
        $todos = $this->parser->parse('TODO parse this todo
        line 2
        line 3');
        self::assertCount(1, $todos);
        $firstTodo = $todos[0];
        self::assertEquals('TODO parse this todo', $firstTodo->getContents());
        self::assertCount(2, explode(PHP_EOL, $firstTodo->getContext()));
    }

    public function testEmptyLineBreaksContext()
    {
        $todos = $this->parser->parse('TODO parse this todo
        line 2
        line 3
        
        not context anymore');
        self::assertCount(1, $todos);
        $firstTodo = $todos[0];
        self::assertEquals('TODO parse this todo', $firstTodo->getContents());
        self::assertCount(2, explode(PHP_EOL, $firstTodo->getContext()));
    }

    public function testTodoLineBreaksContext()
    {
        $todos = $this->parser->parse('TODO parse this todo
        line 2
        line 3
        TODO another one
        not context anymore');
        self::assertCount(2, $todos);
        $firstTodo = $todos[0];
        self::assertEquals('TODO parse this todo', $firstTodo->getContents());
        self::assertCount(2, explode(PHP_EOL, $firstTodo->getContext()));
    }

    public function testMultipleTodosOnSameLine()
    {
        $todos = $this->parser->parse('TODO parse this todo todo todo dodo');
        self::assertCount(1, $todos);
        self::assertCount(1, explode(PHP_EOL, $todos[0]->getContext()));
    }

    public function testTodoInMultilineComment()
    {
        $todos = $this->parser->parse('
        /* TODO parse this todo todo todo dodo
        *
        *
        */
        zfqzefqzefqzef
        qzefqzefqzef
        
        notcontext
        ');
        self::assertCount(1, $todos);
        self::assertCount(5, explode(PHP_EOL, $todos[0]->getContext()));
    }

    public function testLowerIndentationBreaksContext()
    {
        $todos = $this->parser->parse('
        class outside context {
            // TOdO The following lines should be in context
            public function () {
                function contents
            }
        }
        ');
        self::assertCount(1, $todos);
        self::assertCount(3, explode(PHP_EOL, $todos[0]->getContext()));
    }

    public function testParseFile()
    {
        $todos = $this->parser->parse((new FileSystem)->readFile(realpath(TESTS_DATA_DIR . '/subfolder/todo.multiple.php')));
        self::assertCount(2, $todos);
        self::assertCount(4, explode(PHP_EOL, $todos[0]->getContext()));
    }

    public function testParseFolder()
    {
        $todos = (new TodoFolderParser)->parse(realpath(TESTS_DATA_DIR));
        self::assertCount(8, $todos);
        self::assertCount(8, explode(PHP_EOL, $todos[0]->getContext()));
    }

    public function testParseFolderRecursive()
    {
        $todos = (new TodoFolderParser)->parse(realpath(TESTS_DATA_DIR), FileSystem::RECURSIVE);
        self::assertCount(15, $todos);
        self::assertCount(8, explode(PHP_EOL, $todos[0]->getContext()));
    }

    protected function setUp()
    {
        $this->parser = new TodoParser;
    }

    protected function tearDown()
    {
        $this->parser = null;
    }
}
