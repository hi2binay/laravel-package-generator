<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use Illuminate\Support\Str;

class TraitMakeCommand extends \Illuminate\Foundation\Console\TraitMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:trait {package} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new trait.';

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
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name): string
    {
        $name = (string)Str::of($name)->replaceFirst($this->rootNamespace(), '');
        $packageName = trim($this->argument('package'));
        $pkg_array = explode("\\", $packageName);
        $pkg_replace_array = [];
        foreach($pkg_array as $a) {
            $pkg_replace_array[] = Str::kebab($a);
        }
        $package_dir = implode(DIRECTORY_SEPARATOR, $pkg_replace_array);

        return base_path('packages'.DIRECTORY_SEPARATOR) . $package_dir . DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Traits'.DIRECTORY_SEPARATOR . str_replace('\\', '/', $name) . '.php';
    }
}
