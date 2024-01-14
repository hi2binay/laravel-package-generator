<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use Illuminate\Support\Str;

class PolicyMakeCommand extends \Illuminate\Foundation\Console\PolicyMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:policy {package} {name} {--m|model=} {--g|guard=} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new policy.';

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
