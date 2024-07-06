<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;
use Illuminate\Support\Str;

class RequestMakeCommand extends \Illuminate\Foundation\Console\RequestMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:request {package} {name} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new request.';

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace(): string
    {
        return Str::studly(str_replace('-',' ', trim($this->argument('package')))) . '\\';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Requests';
    }

    /**
     * @param string $name
     * @return string
     */
    protected function getPath($name)
    {
        $pkg_dir = Str::kebab(str_replace('-',' ', trim($this->argument('package'))));
        $path = base_path('packages/' . $pkg_dir) . '/src/Http/Requests';

        return $path . '/' . $this->argument('name') . '.php';
    }
}
