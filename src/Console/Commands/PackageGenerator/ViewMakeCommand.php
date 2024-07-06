<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;
use Illuminate\Support\Str;

class ViewMakeCommand extends \Illuminate\Foundation\Console\ViewMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:view {package} {name} {--extension=blade.php} {--test} {--pest} {--f|force} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new view.';

    /**
     * Get the destination view path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name)
    {
        return $this->viewPath(
            $this->getNameInput() . '.' . $this->option('extension'),
        );
    }

    /**
     * Get the first view directory path from the application configuration.
     *
     * @param string $path
     * @return string
     */
    protected function viewPath($path = '')
    {
        $pkg_dir = Str::kebab(str_replace('-',' ', trim($this->argument('package'))));
        $views = base_path('/packages/' . $pkg_dir . '/resources/views');

        return $views . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}
