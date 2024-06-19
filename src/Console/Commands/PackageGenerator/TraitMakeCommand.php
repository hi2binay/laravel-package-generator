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

        return $this->argument('package') . '\\';
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

        return base_path('packages/') . str_replace('\\', '/', $this->argument('package')) . '/src/' . str_replace('\\', '/', $name) . '.php';
    }
}
