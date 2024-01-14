<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use Illuminate\Support\Str;

class FactoryMakeCommand extends \Illuminate\Database\Console\Factories\FactoryMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:factory {package} {name} {--m|model}{--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new factory.';

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace(): string
    {

        return $this->argument('package') . '\\Database\Factories\\';
    }

    /**
     * Build the class with the given name.
     *
     * @param string $name
     * @return string
     */
    protected function buildClass($name)
    {
        $factory = class_basename(Str::ucfirst(str_replace('Factory', '', $name)));

        $namespaceModel = $this->option('model')
            ? $this->qualifyModel($this->option('model'))
            : $this->qualifyModel($this->guessModelName($name));

        $model = class_basename($namespaceModel);

        $namespace = $this->argument('package') . '\\Database\Factories';

        $replace = [
            'Database\\Factories' => $namespace,
            'NamespacedDummyModel' => $namespaceModel,
            '{{ namespacedModel }}' => $namespaceModel,
            '{{namespacedModel}}' => $namespaceModel,
            'DummyModel' => $model,
            '{{ model }}' => $model,
            '{{model}}' => $model,
            '{{ factory }}' => $factory,
            '{{factory}}' => $factory,
        ];

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * Qualify the given model class base name.
     *
     * @param string $model
     * @return string
     */
    protected function qualifyModel(string $model)
    {
        $model = ltrim($model, '\\/');

        $model = str_replace('/', '\\', $model);

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($model, $rootNamespace)) {
            return $model;
        }

        return $this->argument('package') . '\\Models\\' . $model;
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name): string
    {
        $name = (string)Str::of($name)->replaceFirst($this->rootNamespace(), '')->finish('Factory');

        return base_path('packages/') . str_replace('\\', '/', $this->argument('package')) . '/database/factories/' . str_replace('\\', '/', $name) . '.php';
    }
}
