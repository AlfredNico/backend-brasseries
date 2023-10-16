<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class InterfaceMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:interface {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Interface class';


    protected function getStub() {
        return __DIR__ . '/stubs/interface.stub';
    }


    /**
     * Execute the console command.
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\Interfaces';
    }
}
