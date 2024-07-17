<?php

namespace App\Console\Commands\PackageGenerator;
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
        $packageName = trim($this->argument('package'));
        $pkg_array = explode("\\", $packageName);
        $pkg_replace_array = [];
        foreach($pkg_array as $a) {
            $pkg_replace_array[] = Str::kebab($a);
        }
        $package_dir = implode(DIRECTORY_SEPARATOR, $pkg_replace_array);

        return $package_dir . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}
