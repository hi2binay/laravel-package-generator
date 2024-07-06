<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator\Traits;

use Illuminate\Support\Str;

trait  ArtisanNamespace
{

    /**
     * package dir
     */
    public $packageDir = null;

    /**
     * Package namespace
     */
    public $packageNamespace = null;

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        $this->packageDir = Str::kebab(str_replace('-',' ', trim($this->argument('package'))));

        return base_path('/packages/') . $this->packageDir . '/src/' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace(): string
    {
        $this->packageNamespace = Str::studly(str_replace('-',' ', trim($this->argument('package'))));
        $this->packageDir = Str::kebab(str_replace('-',' ', trim($this->argument('package'))));

        return $this->packageNamespace . '\\';
    }
}
