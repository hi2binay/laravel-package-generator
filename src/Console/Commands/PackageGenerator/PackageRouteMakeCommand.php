<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;


class PackageRouteMakeCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:route {package} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new route file.';

    /**
     * @return mixed
     */
    protected function getStubContents()
    {
        return $this->packageGenerator->getStubContents('web', $this->getStubVariables());
    }

    /**
     * @return array
     */
    protected function getStubVariables()
    {
        return [
            'CONTROLLER_CLASS_NAME' => $this->getClassNamespace($this->argument('package') . '/Http/Controllers/' . $this->getStudlyName() . 'Controller'),
            'LOWER_NAME' => $this->getLowerName(),
            'PACKAGE_NAMESPACE' =>$this->getStudlyName()
        ];
    }

    /**
     * @return string
     */
    protected function getSourceFilePath()
    {
        $path = base_path('packages/' . $this->argument('package')) . '/routes';

        return $path . '/web.php';
    }
}
