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
        $packageName = trim($this->argument('package'));
        $pkg_array = explode("\\", $packageName);
        $pkg_replace_array = [];
        foreach($pkg_array as $a) {
            $pkg_replace_array[] = Str::kebab($a);
        }
        $package_dir = implode(DIRECTORY_SEPARATOR, $pkg_replace_array);
        $path = base_path('packages'.DIRECTORY_SEPARATOR . $package_dir) .DIRECTORY_SEPARATOR. 'src'.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Requests';

        return $path . DIRECTORY_SEPARATOR . $this->argument('name') . '.php';
    }
}
