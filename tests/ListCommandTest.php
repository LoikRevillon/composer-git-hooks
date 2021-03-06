<?php

namespace BrainMaestro\GitHooks\Tests;

use BrainMaestro\GitHooks\Commands\ListCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ListCommandTester extends TestCase
{
    use PrepareHookTest;

    private $commandTester;

    public function setUp()
    {
        self::createHooks();
        $command = new ListCommand(self::$hooks);
        $this->commandTester = new CommandTester($command);
    }

    /**
     * @test
     */
    public function it_lists_hooks_that_exist()
    {
        $this->commandTester->execute([]);

        foreach (array_keys(self::$hooks) as $hook) {
            $this->assertContains($hook, $this->commandTester->getDisplay());
        }
    }

    /**
     * @test
     */
    public function it_uses_a_different_git_path_if_specified()
    {
        $gitDir = 'test-git-dir';

        create_hooks_dir($gitDir, 0777);

        self::createHooks($gitDir);

        $this->commandTester->execute(['--git-dir' => $gitDir]);

        foreach (array_keys(self::$hooks) as $hook) {
            $this->assertContains($hook, $this->commandTester->getDisplay());
        }

        $this->recursive_rmdir($gitDir);
    }
}
