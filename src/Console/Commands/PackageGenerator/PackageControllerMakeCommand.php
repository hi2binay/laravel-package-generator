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
    protected $description = 'Create a new default package base controller.';

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
            'NAMESPACE' => $this->getClassNamespace($this->packageNamespace . '/Http/Controllers'),
            'CLASS' => $this->getClassName(),
            'LOWER_NAME' => $this->getLowerName(),
        ];
    }

    /**
     * @return string
     */
    protected function getSourceFilePath(): string
    {
        $path = base_path('packages'.DIRECTORY_SEPARATOR . $this->packageFolder) . DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Controllers';

        return $path . DIRECTORY_SEPARATOR . $this->getClassName() . '.php';
    }
}
