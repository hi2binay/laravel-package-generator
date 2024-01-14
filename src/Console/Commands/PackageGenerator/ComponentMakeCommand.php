<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator\Traits\ArtisanNamespace;

class ComponentMakeCommand extends \Illuminate\Foundation\Console\ComponentMakeCommand
{
    use ArtisanNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:component {package} {name} {--inline} {--view} {--test} {--pest} {--f|force}';


    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\View\Components';
    }

    /**
     * Get the first view directory path from the application configuration.
     *
     * @param string $path
     * @return string
     */
    protected function viewPath($path = '')
    {
        $views = base_path('/packages/' . $this->argument('package') . '/resources/views');

        return $views . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}
