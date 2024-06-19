<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use Illuminate\Config\Repository as Config;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class Generator
{
    /**
     * The package vendor namespace
     *
     * @var string
     */
    protected string $vendorNamespace;

    /**
     * The package name
     *
     * @var string
     */
    protected string $packageName;

    /**
     * Repository object
     *
     * @var Config
     */
    protected Config $config;

    /**
     * Filesystem object
     *
     * @var Filesystem
     */
    protected Filesystem $filesystem;

    /**
     * Package object
     *
     * @var Package
     */
    protected Package $package;

    /**
     * @var boolean
     */
    protected bool $plain;

    /**
     * @var boolean
     */
    protected bool $force;

    /**
     * @var boolean
     */
    protected string|bool $type = 'package';

    /**
     * Contains subs files information
     *
     * @var string|array
     */
    protected string|array $stubFiles = [
        'package' => [
            'scaffold/local' => './../config/local.php',
            //'webpack' => '../webpack.mix.js',
            //'package' => '../package.json',
        ],
    ];

    /**
     * Contains package file paths for creation
     *
     * @var array
     */
    protected array $paths = [
        'package' => [
            'config' => './../config',
            'command' => 'Console/Commands',
            'migration' => './../database/migrations',
            'factories' => './../database/factories',
            'seeder' => './../database/seeders',
            //'contracts' => 'Contracts',
            'model' => 'Models',
            'routes' => './../routes',
            'tests' => './../tests',
            'tests_feature' => './../tests/Feature',
            'tests_unit' => './../tests/Unit',
            'controller' => 'Http/Controllers',
            'middleware' => 'Http/Middleware',
            'request' => 'Http/Requests',
            'provider' => 'Providers',
            'traits' => 'Traits',
            //'repository' => 'Repositories',
            //'facades' => 'Facades',
            //'event' => 'Events',
            //'listener' => 'Listeners',
            //'emails' => 'Mail',
            //'assets' => './../resources/assets',
            'lang' => './../lang',
            'views' => './../resources/views',
        ],
    ];
    protected Command $console;

    /**
     * The constructor.
     *
     * @param Config $config
     * @param Filesystem $filesystem
     * @param Package $package
     */
    public function __construct(
        Config     $config,
        Filesystem $filesystem,
        Package    $package
    )
    {
        $this->config = $config;

        $this->filesystem = $filesystem;

        $this->package = $package;
    }

    /**
     * Set console
     *
     * @param Command $console
     * @return Generator
     */
    public function setConsole(Command $console): static
    {
        $this->console = $console;

        return $this;
    }

    /**
     * Set package.
     *
     * @param string $packageName
     * @return Generator
     */
    public function setPackage(string $packageName): static
    {
        $this->packageName = $packageName;

        return $this;
    }

    /**
     * Set package plain.
     *
     * @param string $plain
     * @return Generator
     */
    public function setPlain(string $plain): static
    {
        $this->plain = $plain;

        return $this;
    }

    /**
     * Set force status.
     *
     * @param boolean $force
     * @return Generator
     */
    public function setForce(bool $force): static
    {
        $this->force = $force;

        return $this;
    }

    /**
     * Set type status.
     *
     * @param $type
     * @return Generator
     */
    public function setType($type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Generate package
     *
     * @return void
     */
    public function generate(): void
    {
        if ($this->package->has($this->packageName)) {
            if ($this->force) {
                $this->package->delete($this->packageName);
            } else {
                $this->console->error("Package '{$this->packageName}' already exist !");

                return;
            }
        }

        $this->createFolders();

        if (!$this->plain) {
            $this->createFiles();

            $this->createClasses();

           // $this->setServiceProvider();
        }

        $this->updateComposer();

        $this->console->info("Package '{$this->packageName}' created successfully.");
    }

    /**
     * Generate package folders
     *
     * @return void
     */
    public function createFolders(): void
    {
        foreach ($this->paths[$this->type] as $key => $folder) {
            $path = base_path('packages/' . $this->packageName . '/src') . '/' . $folder;

            $this->filesystem->makeDirectory($path, 0755, true);
        }
    }

    /**
     * Generate package files
     *
     * @return void
     */
    public function createFiles(): void
    {
        $variables = $this->getStubVariables();

        foreach ($this->stubFiles[$this->type] as $stub => $file) {
            $path = base_path('packages/' . $this->packageName . '/src') . '/' . $file;

            if (!$this->filesystem->isDirectory($dir = dirname($path))) {
                $this->filesystem->makeDirectory($dir, 0775, true);
            }

            $this->filesystem->put($path, $this->getStubContents($stub, $variables));

            $this->console->info("Created file : {$path}");
        }
    }

    /**
     * Generate package classes
     *
     * @return void
     */
    public function createClasses(): void
    {
        if ($this->type == 'package') {
            $this->console->call('package:make-provider', [
                'name' => $this->packageName.'ServiceProvider',
                'package' => $this->packageName,
            ]);

            $this->console->call('package:make-route', [
                'package' => $this->packageName
            ]);
            $this->console->call('package:make-controller', [
                'package' => $this->packageName,
                'name' => 'Controller'
            ]);

            $this->console->call('package:testcase', [
                'package' => $this->packageName
            ]);

            $this->console->call('package:composer', [
                'package' => $this->packageName
            ]);

        } else {

        }
    }

    /**
     * add package service provider to config/app.php
     * @return void
     */
    public function setServiceProvider(): void
    {
        $path = base_path('/config/app.php');
        $file = file_get_contents($path);
        $searchFor = '/* * Customer Service Providers */';
        $customProviders = strpos($file, $searchFor);
        if ($customProviders) {
            $newFile = substr_replace($file, $searchFor . "\n\t\t" . $this->packageName . '\\Providers\\' . basename($this->packageName) . 'ServiceProvider::class,', $customProviders, strlen($searchFor));
            file_put_contents($path, $newFile);
        }
    }

    /**
     * update main composer and add package
     * @return void
     */
    public function updateComposer(): void
    {
        $path = base_path('/composer.json');
        if (file_exists($path)) {
            $d = json_decode(file_get_contents($path), true);
            $d['autoload']['psr-4'][$this->packageName . '\\'] = 'packages/' . str_replace('\\', '/', $this->packageName) . '/src';
            $this->filesystem->put($path, json_encode($d, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $this->package->composer->dumpAutoloads();
        }
    }

    /**
     * @return array
     */
    protected function getStubVariables(): array
    {
        return [
            'LOWER_NAME' => $this->getLowerName(),
            'CAPITALIZE_NAME' => $this->getCapitalizeName(),
            'PACKAGE' => $this->getClassNamespace($this->packageName),
            'CLASS' => $this->getClassName(),
        ];
    }

    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return class_basename($this->packageName);
    }

    /**
     * @param string $name
     * @return string
     */
    protected function getClassNamespace(string $name): string
    {
        return str_replace('/', '\\', $name);
    }

    /**
     * Returns content of stub file
     *
     * @param string $stub
     * @param array $variables
     * @return string
     */
    public function getStubContents(string $stub, array $variables = []): string
    {
        $path = __DIR__ . '/stubs/' . $stub . '.stub';

        $contents = file_get_contents($path);

        foreach ($variables as $search => $replace) {
            $contents = str_replace('$' . strtoupper($search) . '$', $replace, $contents);
        }

        return $contents;
    }

    /**
     * @return string
     */
    protected function getCapitalizeName(): string
    {
        return ucwords(class_basename($this->packageName));
    }

    /**
     * @return string
     */
    protected function getLowerName(): string
    {
        return strtolower(class_basename($this->packageName));
    }
}
