<?php

namespace DavidNgugi\Generator\Commands;

use Illuminate\Console\Command;
use DavidNgugi\Generator\Logic\FileManager;

class GenerateClass extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:class {--p|path=Logic : The path to the class. Should be in App directory. Useful for namespacing} {--i|interface= : Interface to implement} {--e|extends= : Class Name to extend} {name* : Name(s) of the class(es)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Generates a class with the specified namespace plus necessary directories";

    /**
     * Instance of FileManager class
     *
     * @var object
     */

    protected $fm;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FileManager $fm)
    {
        parent::__construct();
        $this->fm = $fm;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = ($this->option('path') !== null ) ? $this->option('path') : "Logic";
        $interface_name = $this->option('interface');
        $extend_class = $this->option('extends');
        $class_names = $this->argument('name');

        $is_plural = (count($class_names) > 1) ? 'files' : 'file';

        $this->info('Generating '.$is_plural.'...');
        
        // Generate the required class(es)
        $extend_info = [];
        $interface_info = [];
        
        // Check for Interfaces and generate them
        if($interface_name != null){
            $interface_info = ["name" => $interface_name, "path" => $path, "in_app" => true];
            $this->fm->generateInterface([$interface_name], $path);
        }

        // Check for Interfaces and generate them
        if($extend_class != null){
            $this->fm->generate($path, [$extend_class], $extend_info, $interface_info);
             $extend_info = ["name" => $extend_class, "path" => $path, "in_app" => true];
        }

        $this->fm->generate($path, $class_names, $extend_info, $interface_info);

        $this->info("");

        $this->info("Generated the following ".$is_plural.": ");

        foreach ($class_names as $name) { $this->line("- ".$name." Class"); }
        if($extend_class != null) { $this->line("- ".$extend_class." Class"); }
        if($interface_name != null) { $this->line("- ".$interface_name." Interface"); }
    }
}
