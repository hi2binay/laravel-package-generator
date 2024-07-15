<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;


class PackageApiRouteMakeCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:make-route-api {package} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a package api route file.';

    /**
     * @return mixed
     */
    protected function getStubContents()
    {
        return $this->packageGenerator->getStubContents('api', $this->getStubVariables());
    }

    /**
     * @return array
     */
    protected function getStubVariables()
    {
        return [
            'CONTROLLER_CLASS_NAME' => $this->getClassNamespace($this->packageNamespace . '/Http/Controllers/' . $this->getStudlyName() . 'Controller'),
            'LOWER_NAME' => $this->getLowerName(),
            'PACKAGE_NAMESPACE' =>$this->getStudlyName()
        ];
    }

    /**
     * @return string
     */
    protected function getSourceFilePath()
    {
        $path = base_path('packages/' . $this->packageFolder) . '/routes';

        return $path . '/api.php';
    }
}
