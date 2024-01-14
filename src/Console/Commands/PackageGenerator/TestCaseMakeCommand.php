<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;


class TestCaseMakeCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:testcase {package} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'setup testcase file.';

    /**
     * @return mixed
     */
    protected function getStubContents()
    {
        return $this->packageGenerator->getStubContents('testcase', $this->getStubVariables());
    }

    /**
     * @return array
     */
    protected function getStubVariables()
    {
        return [
            'NAMESPACE' => $this->getClassNamespace($this->argument('package') . '/Tests'),
            'LOWER_NAME' => $this->getLowerName(),
        ];
    }

    /**
     * @return string
     */
    protected function getSourceFilePath()
    {
        $path = base_path('packages/' . $this->argument('package')) . '/tests';

        return $path . '/TestCase.php';
    }
}
