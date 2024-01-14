<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;


class PackageControllerMakeCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:make-controller {name} {package} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin controller.';

    /**
     * @return mixed
     */
    protected function getStubContents(): mixed
    {
        return $this->packageGenerator->getStubContents('/scaffold/package-controller', $this->getStubVariables());
    }

    /**
     * @return array
     */
    protected function getStubVariables(): array
    {
        return [
            'NAMESPACE' => $this->getClassNamespace($this->argument('package') . '/Http/Controllers'),
            'CLASS' => $this->getClassName(),
        ];
    }

    /**
     * @return string
     */
    protected function getSourceFilePath(): string
    {
        $path = base_path('packages/' . $this->argument('package')) . '/src/Http/Controllers';

        return $path . '/' . $this->getClassName() . '.php';
    }
}
