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
        $packageName = trim($this->argument('package'));
        $pkg_array = explode("\\", $packageName);
        $pkg_replace_array = [];
        foreach($pkg_array as $a) {
            $pkg_replace_array[] = Str::kebab($a);
        }
        $package_dir = implode(DIRECTORY_SEPARATOR, $pkg_replace_array);

        return base_path('packages'.DIRECTORY_SEPARATOR . $package_dir . DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR) . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return Str::studly(trim($this->argument('package'))) . '\\Tests';
    }

}
