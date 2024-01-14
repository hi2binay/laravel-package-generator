<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator\Traits;

use Illuminate\Support\Str;

trait  ArtisanNamespace
{

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path('/packages/') . $this->argument('package') . '/src/' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace(): string
    {

        return $this->argument('package') . '\\';
    }
}
