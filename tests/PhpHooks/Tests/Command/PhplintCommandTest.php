<?php

namespace PhpHooks\Tests\Command;

use PhpHooks\Command\PhplintCommand;
use PhpHooks\Tests\CommandTestCase;

/**
 * Class PhplintCommandTest
 *
 * @coversDefaultClass \PhpHooks\Command\PhplintCommand
 * @package PhpHooks\Tests\Command
 */
class PhplintCommandTest extends CommandTestCase
{
    /**
     * @covers ::run
     * @covers \PhpHooks\Abstracts\BaseCommand::doExecute
     */
    public function testRun()
    {
        $invalidFile = __DIR__ . '/../Fixtures/Invalid.php';

        $input = $this->input;
        $input->setArgument('files', serialize([$invalidFile]));

        $command = new PhplintCommand();

        $this->setExpectedException(
            'RuntimeException',
            'PHP Parse error:  syntax error, unexpected end of file, expecting \',\' or \';\' in ' . $invalidFile . ' on line 3'
        );

        $command->run($input, $this->output);
    }

    /**
     * @covers ::run
     */
    public function testRunWithoutPhpFiles()
    {
        $this->runWithoutPhpFiles(new PhplintCommand());
    }

    /**
     * @covers ::configure
     */
    public function testConfigure()
    {
        $command = new PhplintCommand();
        $this->assertEquals('phplint', $command->getName());
    }
}