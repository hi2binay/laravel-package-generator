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
    protected $signature = 'package:test {package} {name} {--u|unit} {--pest} {--phpunit} {--f|force} ';

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
        $pkg_dir = Str::kebab(str_replace('-',' ', trim($this->argument('package'))));

        return base_path('/packages/' . $pkg_dir . '/tests/') . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return Str::studly(str_replace('-',' ', trim($this->argument('package')))) . '\\Tests';
    }

}
