<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use Illuminate\Support\Str;

class TestMakeCommand extends \Illuminate\Foundation\Console\TestMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:test {package} {name} {--u|unit} {--pest} {--f|force} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new view.';

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path('/packages/' . $this->argument('package') . '/tests/') . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return $this->argument('package') . '\\Tests';
    }

}
